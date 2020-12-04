SELECT clients.name AS client_name,
  employees.name AS employee_name,
  bank_accounts.account_number,
  transactions.value,
  transactions.created_at
FROM transactions
  INNER JOIN bank_accounts ON transactions.bank_account_id = bank_accounts.id
  INNER JOIN clients ON clients.id = bank_accounts.client_id
  INNER JOIN employees ON employees.id = transactions.employee_id
WHERE transactions.created_at BETWEEN '' AND ''
ORDER BY transactions.created_at;
