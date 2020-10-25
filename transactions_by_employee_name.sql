SELECT transactions.*
FROM transactions
  INNER JOIN employees ON employees.id = transactions.employee_id
WHERE employees.name LIKE '%%';
