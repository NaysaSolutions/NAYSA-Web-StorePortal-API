/*
    Store Portal Order performance indexes

    Run this on the tenant SQL Server database used by dbo.sproc_PHP_StorePortalOrder.
    These indexes target the repeated store/order/date lookups used by:
      - GetItems
      - LoadWeeklyForecast
      - LoadWeeklyForecastHistory
      - LoadConfirmation
      - SaveWeeklyForecast
      - ConfirmOrder
      - QuerySummary
      - QueryDetail

    After running, compare execution plans and remove any index that duplicates an
    existing production index.
*/

IF OBJECT_ID(N'dbo.STORE_ORDER_HD', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.STORE_ORDER_HD')
          AND name = N'IX_STORE_ORDER_HD_StoreTypeDates'
   )
BEGIN
    CREATE NONCLUSTERED INDEX IX_STORE_ORDER_HD_StoreTypeDates
    ON dbo.STORE_ORDER_HD
    (
        STORE_CODE,
        ORDER_TYPE,
        START_DATE,
        END_DATE,
        CANCELLED,
        ORDER_ID
    )
    INCLUDE
    (
        ORDER_NO,
        STORE_TYPE,
        ORDER_STATUS,
        SUBMITTED
    );
END;
GO

IF OBJECT_ID(N'dbo.STORE_ORDER_HD', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.STORE_ORDER_HD')
          AND name = N'IX_STORE_ORDER_HD_TypeOrder'
   )
BEGIN
    CREATE NONCLUSTERED INDEX IX_STORE_ORDER_HD_TypeOrder
    ON dbo.STORE_ORDER_HD
    (
        ORDER_TYPE,
        CANCELLED,
        ORDER_ID
    )
    INCLUDE
    (
        STORE_CODE,
        ORDER_NO,
        STORE_TYPE,
        START_DATE,
        END_DATE
    );
END;
GO

IF OBJECT_ID(N'dbo.STORE_ORDER_DT1', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.STORE_ORDER_DT1')
          AND name = N'IX_STORE_ORDER_DT1_OrderDateItem'
   )
BEGIN
    CREATE NONCLUSTERED INDEX IX_STORE_ORDER_DT1_OrderDateItem
    ON dbo.STORE_ORDER_DT1
    (
        ORDER_ID,
        DELIVERY_DATE,
        ITEM_CODE
    )
    INCLUDE
    (
        DT1_ID,
        ITEM_NAME,
        UOM_CODE,
        ORDER_QTY,
        CONFIRMED,
        CONFIRMED_BY,
        CONFIRMED_DATE,
        ORDER_TYPE,
        ORDER_NO,
        STORE_CODE,
        STORE_TYPE
    );
END;
GO

IF OBJECT_ID(N'dbo.STORE_ORDER_DT1', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.STORE_ORDER_DT1')
          AND name = N'IX_STORE_ORDER_DT1_DateOrderItem'
   )
BEGIN
    CREATE NONCLUSTERED INDEX IX_STORE_ORDER_DT1_DateOrderItem
    ON dbo.STORE_ORDER_DT1
    (
        DELIVERY_DATE,
        ORDER_ID,
        ITEM_CODE
    )
    INCLUDE
    (
        DT1_ID,
        ITEM_NAME,
        UOM_CODE,
        ORDER_QTY,
        CONFIRMED,
        CONFIRMED_BY,
        CONFIRMED_DATE
    );
END;
GO

IF OBJECT_ID(N'dbo.FG_MAST', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.FG_MAST')
          AND name = N'IX_FG_MAST_StorePortalItems'
   )
BEGIN
    CREATE NONCLUSTERED INDEX IX_FG_MAST_StorePortalItems
    ON dbo.FG_MAST
    (
        ACTIVE,
        STORE_ITEM_TAG,
        ITEM_NAME
    )
    INCLUDE
    (
        ITEM_CODE,
        CATEG_CODE,
        UOM_CODE
    );
END;
GO

IF OBJECT_ID(N'dbo.FG_MAST', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.FG_MAST')
          AND name = N'IX_FG_MAST_ItemCodeCategory'
   )
BEGIN
    CREATE NONCLUSTERED INDEX IX_FG_MAST_ItemCodeCategory
    ON dbo.FG_MAST
    (
        ITEM_CODE
    )
    INCLUDE
    (
        ITEM_NAME,
        CATEG_CODE,
        UOM_CODE,
        STORE_ITEM_TAG,
        ACTIVE
    );
END;
GO

IF OBJECT_ID(N'dbo.BRANCH_REF', N'U') IS NOT NULL
   AND NOT EXISTS (
        SELECT 1
        FROM sys.indexes
        WHERE object_id = OBJECT_ID(N'dbo.BRANCH_REF')
          AND name = N'IX_BRANCH_REF_StorePortalCode'
   )
BEGIN
    DECLARE @branchCodeColumn SYSNAME = NULL;
    DECLARE @branchTypeColumn SYSNAME = NULL;
    DECLARE @branchIndexSql NVARCHAR(MAX);

    SELECT TOP 1 @branchCodeColumn = C.name
    FROM sys.columns C
    WHERE C.object_id = OBJECT_ID(N'dbo.BRANCH_REF')
      AND UPPER(C.name) IN ('BRANCH_CODE', 'BRANCHCODE', 'CODE')
    ORDER BY CASE UPPER(C.name)
                WHEN 'BRANCH_CODE' THEN 1
                WHEN 'BRANCHCODE' THEN 2
                WHEN 'CODE' THEN 3
                ELSE 99
             END;

    SELECT TOP 1 @branchTypeColumn = C.name
    FROM sys.columns C
    WHERE C.object_id = OBJECT_ID(N'dbo.BRANCH_REF')
      AND UPPER(C.name) IN ('STORE_TYPE', 'STORETYPE', 'BRANCH_TYPE', 'BRANCHTYPE', 'MAIN')
    ORDER BY CASE UPPER(C.name)
                WHEN 'STORE_TYPE' THEN 1
                WHEN 'STORETYPE' THEN 2
                WHEN 'BRANCH_TYPE' THEN 3
                WHEN 'BRANCHTYPE' THEN 4
                WHEN 'MAIN' THEN 5
                ELSE 99
             END;

    IF @branchCodeColumn IS NOT NULL
    BEGIN
        SET @branchIndexSql = N'CREATE NONCLUSTERED INDEX IX_BRANCH_REF_StorePortalCode ON dbo.BRANCH_REF (' + QUOTENAME(@branchCodeColumn) + N')';

        IF @branchTypeColumn IS NOT NULL AND @branchTypeColumn <> @branchCodeColumn
            SET @branchIndexSql += N' INCLUDE (' + QUOTENAME(@branchTypeColumn) + N')';

        EXEC sp_executesql @branchIndexSql;
    END;
END;
GO
