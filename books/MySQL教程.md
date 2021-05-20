## 前言

该文档是记录阅读MySQL教程过程中，遇到的一些个人认为实用但很少用到的函数等内容。菜鸟可看，高手请绕行。

## 教程地址

[传送门](https://www.begtut.com/mysql/mysql-tutorial.html)

## 开始阅读

1. [MySQL ORDER BY 子句](https://www.begtut.com/mysql/mysql-order-by.html)

    MySQL ORDER BY 使用自定义排序顺序，ORDER BY 子句可以使用 FIELD() 函数为列中的值定义自己的自定义排序顺序。
    
    ```
    SELECT
        orderNumber, status
    FROM
        orders
    ORDER BY FIELD(status,
        'In Process',
        'On Hold',
        'Cancelled',
        'Resolved',
        'Disputed','Shipped'); 
    ```
   
2. [MySQL BETWEEN 运算符](https://www.begtut.com/mysql/mysql-between.html)

    本章节了解了一个 cast() 函数，该函数用于类型转换。
    
    ```
    SELECT 
       orderNumber,
       requiredDate,
       status
    FROM 
       orders
    WHERE 
       requireddate BETWEEN 
         CAST('2013-01-01' AS DATE) AND 
         CAST('2013-01-31' AS DATE); 
    ```
   
3. [MySQL GROUP BY](https://www.begtut.com/mysql/mysql-group-by.html)

    GROUP BY子句：MySQL与标准SQL。
    
    > 标准SQL不允许您在GROUP BY子句中使用别名，但MySQL支持此功能。
    
4. [MySQL ROLLUP](https://www.begtut.com/mysql/mysql-rollup.html)

    - ROLLUP子句是GROUP BY子句的扩展，具有以下语法：
    
    ```
    SELECT 
        select_list
    FROM 
        table_name
    GROUP BY
        c1, c2, c3 WITH ROLLUP; 
    ```
   
    ROLLUP在每次产品线更改时生成小计行，在结果结束时生成总计。
    
    - GROUPING() 函数
    
    要检查NULL结果集中是否表示小计或总计，请使用GROUPING()函数。
    
    当NULL在超级聚合时，GROUPING()函数返回1 ，否则返回0。
    
    GROUPING()函数可用于查询，HAVING子句和（从MySQL 8.0.12开始）ORDER BY子句。
    
    ```
    SELECT 
        orderYear,
        productLine, 
        SUM(orderValue) totalOrderValue,
        GROUPING(orderYear),
        GROUPING(productLine)
    FROM
        sales
    GROUP BY 
        orderYear,
        productline
    WITH ROLLUP; 
    ```
   
    ```
    +-----------+------------------+-----------------+---------------------+-----------------------+
    | orderYear | productLine      | totalOrderValue | GROUPING(orderYear) | GROUPING(productLine) |
    +-----------+------------------+-----------------+---------------------+-----------------------+
    |      2013 | Classic Cars     |         5571.80 |                   0 |                     0 |
    |      2013 | Motorcycles      |         2440.50 |                   0 |                     0 |
    |      2013 | Planes           |         4825.44 |                   0 |                     0 |
    |      2013 | Ships            |         5072.71 |                   0 |                     0 |
    |      2013 | Trains           |         2770.95 |                   0 |                     0 |
    |      2013 | Trucks and Buses |         3284.28 |                   0 |                     0 |
    |      2013 | Vintage Cars     |         4080.00 |                   0 |                     0 |
    |      2013 | NULL             |        28045.68 |                   0 |                     1 |
    |      2014 | Classic Cars     |         8124.98 |                   0 |                     0 |
    |      2014 | Motorcycles      |         2598.77 |                   0 |                     0 |
    |      2014 | Planes           |         2857.35 |                   0 |                     0 |
    |      2014 | Ships            |         4301.15 |                   0 |                     0 |
    |      2014 | Trains           |         4646.88 |                   0 |                     0 |
    |      2014 | Trucks and Buses |         4615.64 |                   0 |                     0 |
    |      2014 | Vintage Cars     |         2819.28 |                   0 |                     0 |
    |      2014 | NULL             |        29964.05 |                   0 |                     1 |
    |      2015 | Classic Cars     |         5971.35 |                   0 |                     0 |
    |      2015 | Motorcycles      |         4004.88 |                   0 |                     0 |
    |      2015 | Planes           |         4018.00 |                   0 |                     0 |
    |      2015 | Ships            |         3774.00 |                   0 |                     0 |
    |      2015 | Trains           |         1603.20 |                   0 |                     0 |
    |      2015 | Trucks and Buses |         6295.03 |                   0 |                     0 |
    |      2015 | Vintage Cars     |         5346.50 |                   0 |                     0 |
    |      2015 | NULL             |        31012.96 |                   0 |                     1 |
    |      NULL | NULL             |        89022.69 |                   1 |                     1 |
    +-----------+------------------+-----------------+---------------------+-----------------------+
    ```
   
    当NULL在orderYear 列发生在行聚合时， GROUPING(orderYear)时返回1 ，否则为0。
    
    类似地，当NULL在productLine列发生行聚合时，GROUPING(productLine)当返回1 ，否则为0。
    
    我们经常使用GROUPING()函数将有意义的标签替换为超级聚合NULL值，而不是直接显示它。
    
    以下示例显示如何将IF()函数与GROUPING()函数组合以替换超聚合NULL值orderYear和productLine列中的标签：
    
    ```
    SELECT 
        IF(GROUPING(orderYear),
            'All Years',
            orderYear) orderYear,
        IF(GROUPING(productLine),
            'All Product Lines',
            productLine) productLine,
        SUM(orderValue) totalOrderValue
    FROM
        sales
    GROUP BY 
        orderYear , 
        productline 
    WITH ROLLUP; 
    ```
   
    输出结果：
    
    ```
    +-----------+-------------------+-----------------+
    | orderYear | productLine       | totalOrderValue |
    +-----------+-------------------+-----------------+
    | 2013      | Classic Cars      |         5571.80 |
    | 2013      | Motorcycles       |         2440.50 |
    | 2013      | Planes            |         4825.44 |
    | 2013      | Ships             |         5072.71 |
    | 2013      | Trains            |         2770.95 |
    | 2013      | Trucks and Buses  |         3284.28 |
    | 2013      | Vintage Cars      |         4080.00 |
    | 2013      | All Product Lines |        28045.68 |
    | 2014      | Classic Cars      |         8124.98 |
    | 2014      | Motorcycles       |         2598.77 |
    | 2014      | Planes            |         2857.35 |
    | 2014      | Ships             |         4301.15 |
    | 2014      | Trains            |         4646.88 |
    | 2014      | Trucks and Buses  |         4615.64 |
    | 2014      | Vintage Cars      |         2819.28 |
    | 2014      | All Product Lines |        29964.05 |
    | 2015      | Classic Cars      |         5971.35 |
    | 2015      | Motorcycles       |         4004.88 |
    | 2015      | Planes            |         4018.00 |
    | 2015      | Ships             |         3774.00 |
    | 2015      | Trains            |         1603.20 |
    | 2015      | Trucks and Buses  |         6295.03 |
    | 2015      | Vintage Cars      |         5346.50 |
    | 2015      | All Product Lines |        31012.96 |
    | All Years | All Product Lines |        89022.69 |
    +-----------+-------------------+-----------------+
    ```
   
5. [MySQL INNER JOIN子句](https://www.begtut.com/mysql/mysql-inner-join.html)

    using() 函数的使用
    
    由于两个表的连接列具有相同的名称   productline，因此可以使用以下语法：
    
    ```
    SELECT 
        productCode, 
        productName, 
        textDescription
    FROM
        products
            INNER JOIN
        productlines USING (productline); 
    ```
   
5. [MySQL 复合索引](https://www.begtut.com/mysql/mysql-composite-index.html)
    
    复合索引是多列的索引。MySQL允许您创建一个最多包含16列的复合索引。
    
6. [MySQL 自然语言全文搜索](https://www.begtut.com/mysql/mysql-natural-language-search.html)

    使用全文搜索时，您应记住以下几点：
    
    - 在MySQL全文搜索引擎定义的搜索词的最小长度为4。这意味着，如果你搜索其长度小于4例如关键字car，cat等等，你不会得到任何结果。
    
    - 停用词被忽略。MySQL定义了MySQL源代码分发中的停用词列表 storage/myisam/ft_static.c
    
7. [MySQL 布尔全文搜索](https://www.begtut.com/mysql/mysql-boolean-text-searches.html) 

    MySQL布尔全文搜索主要功能：
    
    - MySQL不会按照布尔全文搜索中相关性降低的顺序自动对行进行排序。
    
    - 要执行布尔查询，InnoDB表要求MATCH表达式的所有列都有FULLTEXT索引。请注意，虽然搜索速度很慢，但MyISAM表并不需要这样。
    
    - MySQL在InnoDB表上的搜索查询中不支持多个布尔运算符，例如'++ mysql'。如果你这样做，MySQL将返回错误。但是，MyISAM的行为有所不同。它忽略其他运算符并使用最接近搜索词的运算符，例如，'+ -mysql'将变为'-mysql'。
    
    - InnoDB全文搜索不支持尾随加号（+）或减号（ - ）。它只支持前导加号或减号。如果搜索单词是'mysql +'或'mysql-'，MySQL将报告错误。此外，带有通配符的以下前导加号或减号无效：+ *，+ -
    
    - 未应用50％阈值。顺便说一句，50％阈值意味着如果一个单词出现在超过50％的行中，MySQL将在搜索结果中忽略它。

8. [MySQL ngram](https://www.begtut.com/mysql/mysql-ngram-full-text-parser.html)

    处理停用词
    
    - ngram解析器排除包含禁用词列表中的停用词的令牌。例如，假设ngram_token_size为2且文档包含"abc"。ngram解析器将文档标记为"ab"和"bc"。如果"b"是一个停用词，ngram将排除两者"ab"，"bc"因为它们包含"b"。
    
    - 请注意，如果语言不是英语，则必须定义自己的禁用词列表。此外，长度大于的停用词将ngram_token_size被忽略。
    
    - 在本教程中，您学习了如何使用MySQL ngram全文解析器来处理表意语言的全文搜索。

9. 


