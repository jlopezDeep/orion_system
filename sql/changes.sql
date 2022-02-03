SET
  sql_mode = '';
ALTER TABLE
  item_foods
ADD
  COLUMN color VARCHAR(15)
AFTER
  tax1;
SET
  sql_mode = '';
ALTER TABLE
  item_category
ADD
  COLUMN color VARCHAR(15)
AFTER
  DateLocked;
SET
  sql_mode = '';
ALTER TABLE
  settings
ADD
  COLUMN password_main VARCHAR(100)
AFTER
  maxreserveperson;
SET
  sql_mode = '';
ALTER TABLE
  settings
ADD
  COLUMN id_vallet_parking_product VARCHAR(100)
AFTER
  password_main;
SET
  sql_mode = '';
ALTER TABLE
  item_foods
ADD
  COLUMN color VARCHAR(15)
AFTER
  tax1;
SET
  sql_mode = '';
ALTER TABLE
  item_category
ADD
  COLUMN color VARCHAR(15)
AFTER
  DateLocked;
SET
  sql_mode = '';
ALTER TABLE
  customer_order
ADD
  COLUMN user_view INT
AFTER
  tokenprint;
SET
  sql_mode = '';
ALTER TABLE
  customer_order
ADD
  COLUMN journal_id INT
AFTER
  user_view;
SET
  sql_mode = '';
ALTER TABLE
  customer_order
ADD
  COLUMN ip_origin VARCHAR(100)
AFTER
  journal_id;
SET
  sql_mode = '';
ALTER TABLE
  rest_table
ADD
  COLUMN user_view INT
AFTER
  status;
CREATE TABLE `journal` (
    `id` int(11) NOT NULL,
    `start` datetime DEFAULT current_timestamp(),
    `end` datetime DEFAULT NULL,
    `active` int(11) DEFAULT NULL,
    `user_id` int(11) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ALTER TABLE
  `journal`
ADD
  PRIMARY KEY (`id`);
ALTER TABLE
  `journal`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;
CREATE TABLE `station` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `ip` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `status` int DEFAULT NULL,
    `is_billing_station` int DEFAULT NULL,
    `is_update` int DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
SET
  sql_mode = '';
ALTER TABLE
  item_foods
ADD
  COLUMN bodegon INT
AFTER
  color;
SET
  sql_mode = '';
ALTER TABLE
  order_menu
ADD
  COLUMN istransfer INT
AFTER
  isupdate;
-- restaurant.cash_expenses definition
  CREATE TABLE `cash_expenses` (
    `id` int NOT NULL AUTO_INCREMENT,
    `amount` double DEFAULT NULL,
    `date` datetime DEFAULT CURRENT_TIMESTAMP,
    `journal_id` bigint DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
CREATE TABLE `tips` (
    `id` int NOT NULL AUTO_INCREMENT,
    `amount` double DEFAULT NULL,
    `date` datetime DEFAULT CURRENT_TIMESTAMP,
    `journal_id` bigint DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- restaurant.system_param definition
  CREATE TABLE `system_param` (
    `id` int unsigned DEFAULT NULL,
    `name` varchar(100) DEFAULT NULL,
    `description` varchar(1000) DEFAULT NULL,
    `value` varchar(100) DEFAULT NULL,
    `active` bit(1) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
-- restaurant.transfer_history definition
  CREATE TABLE `transfer_history` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `table_origin` bigint DEFAULT NULL,
    `table_destiny` bigint DEFAULT NULL,
    `order_origin` bigint DEFAULT NULL,
    `order_destiny` bigint DEFAULT NULL,
    `date` datetime DEFAULT CURRENT_TIMESTAMP,
    `journal_id` bigint DEFAULT NULL,
    `type` bigint DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
SET
  sql_mode = '';
ALTER TABLE
  user
ADD
  COLUMN pin INT
AFTER
  is_admin;
SET
  sql_mode = '';
ALTER TABLE
  customer_order
ADD
  COLUMN is_mark INT
AFTER
  ip_origin;
SET
  sql_mode = '';
ALTER TABLE
  customer_order
ADD
  COLUMN is_update INT
AFTER
  is_mark;
SET
  sql_mode = '';
ALTER TABLE
  customer_order
ADD
  COLUMN comentario INT
AFTER
  is_update;
LOCK TABLES `system_param` WRITE;
  /*!40000 ALTER TABLE `system_param` DISABLE KEYS */;
INSERT INTO
  `system_param`
VALUES
  (
    1,
    'Moneda Secundaria',
    'El valor indica la tasa de la moneda secundaria con respecto a la moneda principal definida',
    '5.5',
    _binary ''
  ),(
    2,
    'Ruta de Impresion',
    'El valor indica el path de impresion',
    'C:\\Program Files\\Apache Software Foundation\\Tomcat 9.0_Tomcat9-orion\\webapps\\print-server\\Queue\\',
    _binary ''
  ),(
    3,
    'Ruta de facturacion y procesos bematech',
    'El valor indica la ruta donde se configura el path de proceso de bematech monitor',
    'C:\\FISCAL\\',
    _binary ''
  ),(
    4,
    'Precuenta por maquina fiscal',
    'El valor indica si esta activo el modo de precuenta por maquina fiscal',
    '0',
    _binary '\0'
  ),(
    5,
    'Ticket de Factura (No fiscal)',
    'Indica que no se conectara una impresora fiscal.',
    '0',
    _binary ''
  ),
  (
    6,
    'Desactivar impresion de comanda',
    'Desactivar impresion de comanda',
    '0',
    _binary ''
  );
  /*!40000 ALTER TABLE `system_param` ENABLE KEYS */;
UNLOCK TABLES;
SET
  sql_mode = '';
ALTER TABLE
  bill
ADD
  COLUMN change FLOAT
AFTER
  update_date;
SET
  sql_mode = '';
ALTER TABLE
  item_category
ADD
  COLUMN color_category_grid VARCHAR(15)
AFTER
  color;