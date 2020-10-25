SELECT *
FROM bank_accounts
  INNER JOIN clients ON clients.id = bank_accounts.client_id
WHERE clients.name LIKE '%%';
