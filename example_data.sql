INSERT INTO store.bookType
(id, type_code, type_name, type_disc_rate, created_at, updated_at)
VALUES('24113c6c-9f30-11ed-8738-009337e10b18', 'COM', 'Komik', 5.00, '2023-01-29 00:21:03', '2023-01-29 00:21:03');
INSERT INTO store.bookType
(id, type_code, type_name, type_disc_rate, created_at, updated_at)
VALUES('99c53231-9f02-11ed-8738-009337e10b18', 'FIC', 'Fiksi', 15.00, '2023-01-28 18:55:03', '2023-01-28 18:55:03');


INSERT INTO store.book
(id, book_code, book_title, book_author, book_type_id, book_publisher, book_img, created_at, updated_at)
VALUES('6071f0a3-9f30-11ed-8738-009337e10b18', 'N42MS99', 'Naruto Vol. 42', 'Masashi Kishimoto', '24113c6c-9f30-11ed-8738-009337e10b18', 'Gramedia - Shonen Jump', 'naruto-42.jpg', '2023-01-29 00:22:44', '2023-01-29 00:22:44');
INSERT INTO store.book
(id, book_code, book_title, book_author, book_type_id, book_publisher, book_img, created_at, updated_at)
VALUES('daa992c8-9f02-11ed-8738-009337e10b18', 'FHP7JKR07', 'Harry Potter 7', 'J.K. Rowling', '99c53231-9f02-11ed-8738-009337e10b18', 'Gramedia', 'harry-potter-7.jpg', '2023-01-28 18:56:52', '2023-01-28 18:56:52');

INSERT INTO store.bookBalance
(id, book_id, physical_qty, sold_qty, free_flag, created_at, updated_at)
VALUES('5a97d494-9f09-11ed-8738-009337e10b18', 'daa992c8-9f02-11ed-8738-009337e10b18', 100, 0, 0, '2023-01-28 19:43:24', '2023-01-28 19:43:24');
INSERT INTO store.bookBalance
(id, book_id, physical_qty, sold_qty, free_flag, created_at, updated_at)
VALUES('abdf5a22-9f30-11ed-8738-009337e10b18', '6071f0a3-9f30-11ed-8738-009337e10b18', 80, 0, 0, '2023-01-29 00:24:50', '2023-01-29 00:24:50');

INSERT INTO store.price
(id, book_id, unit_price_value, created_at, updated_at)
VALUES('1e0ed20c-9f09-11ed-8738-009337e10b18', 'daa992c8-9f02-11ed-8738-009337e10b18', 200000.00, '2023-01-28 19:41:42', '2023-01-28 19:41:42');
INSERT INTO store.price
(id, book_id, unit_price_value, created_at, updated_at)
VALUES('b0e2aef9-9f30-11ed-8738-009337e10b18', '6071f0a3-9f30-11ed-8738-009337e10b18', 35000.00, '2023-01-29 00:24:59', '2023-01-29 00:24:59');

INSERT INTO store.customer
(id, customer_code, customer_name, customer_address, created_at, updated_at)
VALUES('82e1766d-9fc4-11ed-8738-009337e10b18', 'BERLIN', 'Briliando Simarmata', 'Jakarta, Indonesia', '2023-01-29 18:03:07', '2023-01-29 18:03:07');

INSERT INTO store.discount
(id, book_id, disc_rate, created_at, updated_at)
VALUES('4e2de75e-9f74-11ed-8738-009337e10b18', '6071f0a3-9f30-11ed-8738-009337e10b18', 6.00, '2023-01-29 08:28:59', '2023-01-29 08:28:59');



