SELECT transactions.*
FROM transactions
  INNER JOIN bank_accounts ON transactions.bank_account_id = bank_accounts.id
  INNER JOIN clients ON clients.id = bank_accounts.client_id
WHERE clients.name LIKE '%%'
ORDER BY transactions.created_at;
