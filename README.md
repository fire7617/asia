# 建置環境




# 資料庫題目

## 題目一

```sql
Select o.bnb_id,bnbs.name,Sum(amount) as amount from (
    select bnb_id,amount from orders where currency = 'TWD' and create_at >= 1682870400 and create_at < 1685548800
) o 
left join bnbs
    on o.bnb_id = bnbs.id
GROUP BY bnb_id
ORDER BY amount DESC
LIMIT 10
```

## 題目二

 * Step1: 先將語法使用 explain 去觀察情況. 觀察索引是否命中。
 * Step2: 觀察orders的資料量，是否會因數量過多以致搜尋變慢
 * Step3: 是否有lock table的問題


 Solve
    1.索引加上
　　2.資料量過大
        a.減少orders表的資料，看是否以月作分表
        b.建立新的月分資料表去即時統計資料

　  3.查詢相關log去尋找在時間段內所執行的SQL是否有lockTable 或有事務處理　

　


# API實作測驗

## SOLID說明


依賴反轉原則
    OrderService 使用依賴注入方式，降低耦合

### DesignPattern
Strategy Pattern
    
