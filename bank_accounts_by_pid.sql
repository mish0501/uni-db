SELECT bank_accounts.account_number,
  clients.name,
  bank_accounts.interest_percentage,
  CASE
    WHEN currency_types.id = 1 THEN CONCAT(bank_accounts.cash, currency_types.symbol)
    ELSE CONCAT(currency_types.symbol, bank_accounts.cash)
  END as cash,
  bank_accounts.created_at
FROM bank_accounts
  INNER JOIN clients ON clients.id = bank_accounts.client_id
  INNER JOIN currency_types ON currency_types.id = bank_accounts.currency_type_id
WHERE clients.PID = '';
