drop table if exists bookType;
create table bookType(
id varchar(100),
type_code varchar(10),
type_name varchar(25),
type_disc_rate numeric(5,2),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_bookType unique(type_code)
);

drop table if exists book;
create table book(
id varchar(100),
book_code varchar(10),
book_title varchar(100),
book_author varchar(100),
book_type_id varchar(100),
book_publisher varchar(50),
book_img varchar(100),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_book unique(book_code),
FOREIGN KEY(book_type_id) REFERENCES bookType(id)
);

drop table if exists bookBalance;
create table bookBalance(
id varchar(100),
book_id varchar(100),
physical_qty numeric(7,0),
sold_qty numeric(7,0),
free_flag boolean,
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_bookBalance unique(book_id),
FOREIGN KEY(book_id) REFERENCES book(id)
);

DROP table if exists customer;
create table customer(
id varchar(100),
customer_code varchar(10),
customer_name varchar(70),
customer_address varchar(250),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_customer unique(customer_code)
);

DROP table if exists price;
create table price(
id varchar(100),
book_id varchar(100),
unit_price_value numeric(11,2),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_price unique(book_id),
FOREIGN KEY(book_id) REFERENCES book(id)
);

drop table if exists invoice;
create table invoice(
id varchar(100),
trx_number varchar(10),
trx_date date,
trx_hours time,
customer_id varchar(100),
total_qty numeric(7,0),
total_prc numeric(11,2),
total_disc_val numeric(11,2),
total_prc_aftr_disc numeric(11,2),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_invoice unique(trx_number, trx_date, trx_hours, customer_id),
FOREIGN KEY(customer_id) REFERENCES customer(id)
);


drop table if exists invoiceDetail;
create table invoiceDetail(
id varchar(100),
invoice_id varchar(100),
book_id varchar(100),
book_qty numeric(7,0),
book_price numeric(11,2),
book_disc_val numeric(11,2),
book_disc_rate numeric(5,2),
book_type_disc_val numeric(11,2),
book_type_disc_rate numeric(5,2),
book_price_aftr_disc numeric(11,2),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_invoiceDetail unique(invoice_id, book_id),
FOREIGN KEY(invoice_id) REFERENCES invoice(id),
fOREIGN KEY(book_id) REFERENCES book(id)
);

drop table if exists discount;
create table discount(
id varchar(100),
book_id varchar(100),
disc_rate numeric(5,2),
created_at datetime,
updated_at datetime,
primary key (id),
constraint bk_discount unique(book_id),
fOREIGN KEY(book_id) REFERENCES book(id)
);

