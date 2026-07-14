USE kedai_kopi;
UPDATE user SET password = '$2y$10$WH9TdF0tyVEunrUQOpjFPeWDoqvexSRgwwxayXMF7FDUQKVYpAI2i' WHERE email = 'admin@kedaikopi.com';
SELECT email, password FROM user WHERE email = 'admin@kedaikopi.com';
