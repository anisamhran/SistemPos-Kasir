USE uasfixpbdprak23;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema uasfixpbdprak23
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema uasfixpbdprak23
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `uasfixpbdprak23` DEFAULT CHARACTER SET utf8 ;
USE `uasfixpbdprak23` ;

-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`role` (
  `idrole` INT NOT NULL AUTO_INCREMENT,
  `nama_role` VARCHAR(100) NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`idrole`))
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`user_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`user_table` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(100) NULL,
  `idrole` INT NOT NULL,
   `deleted_at` DATE,
  PRIMARY KEY (`iduser`),
  INDEX `fk_user_role_idx` (`idrole` ASC) VISIBLE,
  CONSTRAINT `fk_user_role`
    FOREIGN KEY (`idrole`)
    REFERENCES `uasfixpbdprak23`.`role` (`idrole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`satuan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`satuan` (
  `idsatuan` INT NOT NULL AUTO_INCREMENT,
  `nama_satuan` VARCHAR(45) NULL,
  `status` TINYINT NULL,
   `deleted_at` DATE,
  PRIMARY KEY (`idsatuan`))
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`barang`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`barang` (
  `idbarang` INT NOT NULL AUTO_INCREMENT,
  `id_jenis_barang` INT,
  `nama` VARCHAR(45) NULL,
  `idsatuan` INT NOT NULL,
  `status` TINYINT NULL,
  `harga` INT NULL,
   `deleted_at` DATE,
  PRIMARY KEY (`idbarang`),
  INDEX `fk_barang_satuan1_idx` (`idsatuan` ASC) VISIBLE,
  CONSTRAINT `fk_barang_satuan1`
    FOREIGN KEY (`idsatuan`)
    REFERENCES `uasfixpbdprak23`.`satuan` (`idsatuan`),
  CONSTRAINT `fk_jenisbarang_barang`
    FOREIGN KEY (`id_jenis_barang`)
    REFERENCES `uasfixpbdprak23`.`jenis_barang` (`id_jenis_barang`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;

-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`jenis barang`
-- -----------------------------------------------------
CREATE TABLE jenis_barang(
id_jenis_barang INT AUTO_INCREMENT,
nama_jenis VARCHAR(200),
`deleted_at` DATE,
CONSTRAINT jenis_barang_id_pk PRIMARY KEY(id_jenis_barang)
);

-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`vendor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`vendor` (
  `idvendor` INT NOT NULL AUTO_INCREMENT,
  `nama_vendor` VARCHAR(100) NULL,
  `id_badan_hukum` INT,
  `status` CHAR(1) NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`idvendor`),
  CONSTRAINT `fk_badan_hukum`
    FOREIGN KEY (`id_badan_hukum`)
    REFERENCES `uasfixpbdprak23`.`badan_hukum`(`id_badan_hukum`)
)
ENGINE = INNODB;



-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`badan hukum`
-- -----------------------------------------------------
CREATE TABLE badan_hukum(
id_badan_hukum INT AUTO_INCREMENT,
namabadan_hukum VARCHAR(200),
`deleted_at` DATE,
CONSTRAINT badan_hukum_vendor_id_badan_hukum_vendor_pk PRIMARY KEY(id_badan_hukum)
);

-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`pengadaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`pengadaan` (
  `idpengadaan` BIGINT NOT NULL AUTO_INCREMENT,
  `timestamp` TIMESTAMP NULL,
  `user_iduser` INT NOT NULL,
  `status` CHAR(1) NULL,
  `vendor_idvendor` INT NOT NULL,
  `subtotal_nilai` INT NULL,
  `ppn` INT NULL,
  `total_nilai` INT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`idpengadaan`),
  INDEX `fk_pengadaan_user1_idx` (`user_iduser` ASC) VISIBLE,
  INDEX `fk_pengadaan_vendor1_idx` (`vendor_idvendor` ASC) VISIBLE,
  CONSTRAINT `fk_pengadaan_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `uasfixpbdprak23`.`user_table` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pengadaan_vendor1`
    FOREIGN KEY (`vendor_idvendor`)
    REFERENCES `uasfixpbdprak23`.`vendor` (`idvendor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`detail_pengadaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`detail_pengadaan` (
  `iddetail_pengadaan` BIGINT NOT NULL AUTO_INCREMENT,
  `harga_satuan` INT NULL,
  `jumlah` INT NULL,
  `sub_total` INT NULL,
  `idbarang` INT NOT NULL,
  `idpengadaan` BIGINT NOT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`iddetail_pengadaan`),
  INDEX `fk_detail_pengadaan_barang1_idx` (`idbarang` ASC) VISIBLE,
  INDEX `fk_detail_pengadaan_pengadaan1_idx` (`idpengadaan` ASC) VISIBLE,
  CONSTRAINT `fk_detail_pengadaan_barang1`
    FOREIGN KEY (`idbarang`)
    REFERENCES `uasfixpbdprak23`.`barang` (`idbarang`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_pengadaan_pengadaan1`
    FOREIGN KEY (`idpengadaan`)
    REFERENCES `uasfixpbdprak23`.`pengadaan` (`idpengadaan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`penerimaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`penerimaan` (
  `idpenerimaan` BIGINT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NULL,
  `status` CHAR(1) NULL,
  `idpengadaan` BIGINT NOT NULL,
  `iduser` INT NOT NULL,
  PRIMARY KEY (`idpenerimaan`),
  `deleted_at` DATE,
  INDEX `fk_penerimaan_pengadaan1_idx` (`idpengadaan` ASC) VISIBLE,
  INDEX `fk_penerimaan_user1_idx` (`iduser` ASC) VISIBLE,
  CONSTRAINT `fk_penerimaan_pengadaan1`
    FOREIGN KEY (`idpengadaan`)
    REFERENCES `uasfixpbdprak23`.`pengadaan` (`idpengadaan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_penerimaan_user1`
    FOREIGN KEY (`iduser`)
    REFERENCES `uasfixpbdprak23`.`user_table` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`detail_penerimaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`detail_penerimaan` (
  `iddetail_penerimaan` BIGINT NOT NULL AUTO_INCREMENT,
  `idpenerimaan` BIGINT NOT NULL,
  `barang_idbarang` INT NOT NULL,
  `jumlah_terima` INT NULL,
  `harga_satuan_terima` INT NULL,
  `sub_total_terima` INT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`iddetail_penerimaan`),
  INDEX `fk_detail_penerimaan_penerimaan1_idx` (`idpenerimaan` ASC) VISIBLE,
  INDEX `fk_detail_penerimaan_barang1_idx` (`barang_idbarang` ASC) VISIBLE,
  CONSTRAINT `fk_detail_penerimaan_penerimaan1`
    FOREIGN KEY (`idpenerimaan`)
    REFERENCES `uasfixpbdprak23`.`penerimaan` (`idpenerimaan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_penerimaan_barang1`
    FOREIGN KEY (`barang_idbarang`)
    REFERENCES `uasfixpbdprak23`.`barang` (`idbarang`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`retur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`retur` (
  `idretur` BIGINT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NULL,
  `idpenerimaan` BIGINT NOT NULL,
  `iduser` INT NOT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`idretur`),
  INDEX `fk_retur_penerimaan1_idx` (`idpenerimaan` ASC) VISIBLE,
  INDEX `fk_retur_user1_idx` (`iduser` ASC) VISIBLE,
  CONSTRAINT `fk_retur_penerimaan1`
    FOREIGN KEY (`idpenerimaan`)
    REFERENCES `uasfixpbdprak23`.`penerimaan` (`idpenerimaan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_retur_user1`
    FOREIGN KEY (`iduser`)
    REFERENCES `uasfixpbdprak23`.`user_table` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`detail_retur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`detail_retur` (
  `iddetail_retur` INT NOT NULL AUTO_INCREMENT,
  `jumlah` INT NULL,
  `alasan` VARCHAR(200) NULL,
  `idretur` BIGINT NOT NULL,
  `iddetail_penerimaan` BIGINT NOT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`iddetail_retur`),
  INDEX `fk_detail_retur_retur1_idx` (`idretur` ASC) VISIBLE,
  INDEX `fk_detail_retur_detail_penerimaan1_idx` (`iddetail_penerimaan` ASC) VISIBLE,
  CONSTRAINT `fk_detail_retur_retur1`
    FOREIGN KEY (`idretur`)
    REFERENCES `uasfixpbdprak23`.`retur` (`idretur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_retur_detail_penerimaan1`
    FOREIGN KEY (`iddetail_penerimaan`)
    REFERENCES `uasfixpbdprak23`.`detail_penerimaan` (`iddetail_penerimaan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`margin_penjualan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`margin_penjualan` (
  `idmargin_penjualan` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NULL,
  `persen` DOUBLE NULL,
  `status` TINYINT NULL,
  `iduser` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`idmargin_penjualan`),
  INDEX `fk_margin_penjualan_user1_idx` (`iduser` ASC) VISIBLE,
  CONSTRAINT `fk_margin_penjualan_user1`
    FOREIGN KEY (`iduser`)
    REFERENCES `uasfixpbdprak23`.`user_table` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`penjualan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`penjualan` (
  `idpenjualan` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NULL,
  `subtotal_nilai` INT NULL,
  `ppn` INT NULL,
  `total_nilai` INT NULL,
  `iduser` INT NOT NULL,
  `idmargin_penjualan` INT NOT NULL,
`deleted_at` DATE,
  PRIMARY KEY (`idpenjualan`),
  INDEX `fk_penjualan_user1_idx` (`iduser` ASC) VISIBLE,
  INDEX `fk_penjualan_margin_penjualan1_idx` (`idmargin_penjualan` ASC) VISIBLE,
  CONSTRAINT `fk_penjualan_user1`
    FOREIGN KEY (`iduser`)
    REFERENCES `uasfixpbdprak23`.`user_table` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_penjualan_margin_penjualan1`
    FOREIGN KEY (`idmargin_penjualan`)
    REFERENCES `uasfixpbdprak23`.`margin_penjualan` (`idmargin_penjualan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`detail_penjualan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`detail_penjualan` (
  `iddetail_penjualan` BIGINT NOT NULL AUTO_INCREMENT,
  `harga_satuan` INT NULL,
  `jumlah` INT NULL,
  `subtotal` INT NULL,
  `penjualan_idpenjualan` INT NOT NULL,
  `idbarang` INT NOT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`iddetail_penjualan`),
  INDEX `fk_detail_penjualan_penjualan1_idx` (`penjualan_idpenjualan` ASC) VISIBLE,
  INDEX `fk_detail_penjualan_barang1_idx` (`idbarang` ASC) VISIBLE,
  CONSTRAINT `fk_detail_penjualan_penjualan1`
    FOREIGN KEY (`penjualan_idpenjualan`)
    REFERENCES `uasfixpbdprak23`.`penjualan` (`idpenjualan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_penjualan_barang1`
    FOREIGN KEY (`idbarang`)
    REFERENCES `uasfixpbdprak23`.`barang` (`idbarang`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


-- -----------------------------------------------------
-- Table `uasfixpbdprak23`.`kartu_stok`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uasfixpbdprak23`.`kartu_stok` (
  `idkartu_stok` BIGINT NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` CHAR(1) NULL,
  `masuk` INT NULL,
  `keluar` INT NULL,
  `stock` INT NULL,
  `created_at` TIMESTAMP NULL,
  `idtransaksi` INT NULL,
  `idbarang` INT NOT NULL,
  `deleted_at` DATE,
  PRIMARY KEY (`idkartu_stok`),
  INDEX `fk_kartu_stok_barang1_idx` (`idbarang` ASC) VISIBLE,
  CONSTRAINT `fk_kartu_stok_barang1`
    FOREIGN KEY (`idbarang`)
    REFERENCES `uasfixpbdprak23`.`barang` (`idbarang`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- SETELAH CREATE SEMUA TABEL, MEMBUAT SEEDER
-- -----------------------------------------------------
INSERT INTO badan_hukum
VALUES (1,'PT',NULL), (2,'CV',NULL), (3,'UD',NULL);

INSERT INTO jenis_barang
VALUES (1,'Makanan',NULL), (2,'Minuman',NULL), (3,'Sembako',NULL), (4,'Alat Tulis',NULL), (5,'Bahan Bangunan',NULL);

INSERT INTO ROLE
VALUES (1,'admin',NULL), (2,'kasir',NULL);

INSERT INTO satuan
VALUES (1,'lusin',1,NULL), (2,'rim',1,NULL), (3,'kodi',0,NULL), (4,'gross',0,NULL), 
(5,'kilogram',0,NULL), (6,'meter',0,NULL), (7,'liter',0,NULL), (8,'pcs',0,NULL);

INSERT INTO vendor
VALUES (1,'PT ANGKASA', '1', '1',NULL), (2,'CV BERKAH ABADI','2','1',NULL), (3,'CV AMAN SEJAHTERA','3','1',NULL);


INSERT INTO user_table
VALUES (2,'kasir@example.com','kasir123',2,NULL), (1,'admin@example.com', 'admin123',1,NULL);

INSERT INTO barang(`idbarang`, `id_jenis_barang`, `nama`, `idsatuan`, `status`, `harga`, `deleted_at`)
VALUES (1,4,'staedler',8,1,3500,NULL), (2,3,'Minyak Filma',7,1, 16000,NULL), 
(3,5,'Keramik Siangkung',1,1, 140000,NULL), (4,2,'Nutrisari',1,1, 14000,NULL), 
(5,1,'Taro',8,1, 7000,NULL);


-- -----------------------------------------------------
-- FUNCTION HITUNG BIAYA PPN
-- -----------------------------------------------------
DELIMITER //

CREATE FUNCTION fn_hitung_ppn(p_subtotal DECIMAL(10, 2))
RETURNS DECIMAL(10, 2)
DETERMINISTIC
BEGIN
    DECLARE ppn DECIMAL(10, 2);

    -- Hitung PPN
    SET ppn = p_subtotal * 0.11;

    RETURN ppn;
END //

DELIMITER ;


-- -----------------------------------------------------
-- FUNCTION HITUNG GRAND TOTAL PENGADAAN (SUBTOTAL+BIAYA PPN)
-- -----------------------------------------------------
DELIMITER //

CREATE FUNCTION fn_hitung_grand_total(p_subtotal DECIMAL(10, 2))
RETURNS DECIMAL(10, 2)
DETERMINISTIC
BEGIN
    DECLARE ppn DECIMAL(10, 2);
    DECLARE grand_total DECIMAL(10, 2);

    -- Hitung PPN
    SET ppn = p_subtotal * 0.11;

    -- Hitung Grand Total
    SET grand_total = p_subtotal + ppn;

    RETURN grand_total;
END //

DELIMITER ;



-- -----------------------------------------------------
-- STORED PROCEDURE PENGADAAN DAN DETAIL PENGADAAN
-- -----------------------------------------------------
DELIMITER //

CREATE PROCEDURE tambah_pengadaan(
    IN p_user_id INT,
    IN p_vendor_id INT,
    IN p_barang_id INT,
    IN p_harga DECIMAL(10, 2),
    IN p_satuan VARCHAR(255),
    IN p_jenis_barang VARCHAR(255),
    IN p_jumlah INT
)
BEGIN
    DECLARE total_subtotal DECIMAL(10, 2);
    DECLARE total_ppn DECIMAL(10, 2);
    DECLARE total_grand_total DECIMAL(10, 2);
    DECLARE last_id_pengadaan INT;

    -- ...

    -- 3. Menghitung total subtotal, ppn, dan grand total.
    SET total_subtotal = p_harga * p_jumlah;
    SET total_ppn = fn_hitung_ppn(total_subtotal);
    SET total_grand_total = fn_hitung_grand_total(total_subtotal);

    -- 5. Menyimpan data ke dalam tabel 'pengadaan'.
INSERT INTO pengadaan (user_iduser, vendor_idvendor, subtotal_nilai, ppn, total_nilai, STATUS, TIMESTAMP)
VALUES (p_user_id, p_vendor_id, total_subtotal, total_ppn, total_grand_total, 1, NOW());


    -- 6. Mengambil idpengadaan terakhir yang di-generate oleh database.
    SET last_id_pengadaan = LAST_INSERT_ID();
    
    
    -- 7. Menyimpan data ke dalam tabel 'detail_pengadaan'.
    INSERT INTO detail_pengadaan (harga_satuan, jumlah, sub_total, idbarang, idpengadaan)
    VALUES (p_harga, p_jumlah, total_subtotal, p_barang_id, last_id_pengadaan);

END //

DELIMITER ;



-- -----------------------------------------------------
-- STORED PROCEDURE PENERIMAAN DAN DETAIL PENERIMAAN
-- -----------------------------------------------------
DELIMITER //

CREATE PROCEDURE TerimaPengadaan(
    IN p_idpengadaan INT,
    IN p_iduser INT
)
BEGIN
    DECLARE v_idpenerimaan INT;

    -- Insert into penerimaan table
    INSERT INTO penerimaan (created_at, STATUS, idpengadaan, iduser)
    VALUES (NOW(), 1, p_idpengadaan, p_iduser);

    -- Get the last inserted idpenerimaan
    SET v_idpenerimaan = LAST_INSERT_ID();

    -- Insert into detail_penerimaan table
    INSERT INTO detail_penerimaan (idpenerimaan, barang_idbarang, jumlah_terima, harga_satuan_terima, sub_total_terima)
    SELECT
        v_idpenerimaan,
        idbarang,
        jumlah,
        harga_satuan,
        sub_total
    FROM detail_pengadaan
    WHERE idpengadaan = p_idpengadaan;

    -- Mark the accepted pengadaan as processed
    UPDATE pengadaan SET STATUS = 2 WHERE idpengadaan = p_idpengadaan;

END //

DELIMITER ;


-- -----------------------------------------------------
-- VIEW STOK BARANG
-- -----------------------------------------------------
CREATE VIEW v_stok_barang AS
SELECT
    b.idbarang,
    b.nama,
    COALESCE(ks.stock, 0) AS stok
FROM barang b
LEFT JOIN (
    SELECT
        ks.idbarang,
        ks.stock
    FROM kartu_stok ks
    JOIN (
        SELECT
            idbarang,
            MAX(created_at) AS max_created_at
        FROM kartu_stok
        GROUP BY idbarang
    ) max_ks ON ks.idbarang = max_ks.idbarang AND ks.created_at = max_ks.max_created_at
) ks ON b.idbarang = ks.idbarang;


-- -----------------------------------------------------
-- STORED PROCEDURE RETUR DAN DETAIL RETUR
-- -----------------------------------------------------
DELIMITER //

CREATE PROCEDURE tambah_retur(
    IN p_idpenerimaan INT,
    IN p_iduser INT,
    IN p_alasan VARCHAR(255),
    IN p_iddetail_penerimaan INT
)
BEGIN
    DECLARE last_id_retur INT;
    DECLARE v_jumlah INT;
    DECLARE v_iddetail_penerimaan INT;

    -- 1. Menyimpan data ke dalam tabel 'retur'.
    INSERT INTO retur (idpenerimaan, iduser, created_at, deleted_at)
    VALUES (p_idpenerimaan, p_iduser, NOW(), NULL);

    -- 2. Mengambil idretur terakhir yang di-generate oleh database.
    SET last_id_retur = LAST_INSERT_ID();

    -- 3. Mengambil nilai jumlah dan iddetail_penerimaan dari tabel 'detail_penerimaan'.
    SELECT jumlah_terima, iddetail_penerimaan INTO v_jumlah, v_iddetail_penerimaan
    FROM detail_penerimaan
    WHERE iddetail_penerimaan = p_iddetail_penerimaan;

    -- 4. Menyimpan data ke dalam tabel 'detail_retur'.
    INSERT INTO detail_retur (jumlah, alasan, idretur, iddetail_penerimaan, deleted_at)
    VALUES (v_jumlah, p_alasan, last_id_retur, v_iddetail_penerimaan, NULL);

END //

DELIMITER ;


-- -----------------------------------------------------
-- TRIGGER KARTU STOK PENERIMAAN
-- -----------------------------------------------------
DELIMITER $$
CREATE TRIGGER barang_masuk AFTER INSERT ON detail_penerimaan 
FOR EACH ROW BEGIN
    DECLARE old_max_id INT;
    DECLARE stock_lama INT;
    DECLARE stock_now INT;
    
    SELECT MAX(idkartu_stok) INTO old_max_id FROM kartu_stok WHERE idbarang = NEW.barang_idbarang;
    SELECT stock INTO stock_lama FROM kartu_stok WHERE idkartu_stok = old_max_id;

    SET stock_now = COALESCE(stock_lama, 0) + NEW.jumlah_terima;

    INSERT INTO kartu_stok (created_at, jenis_transaksi, masuk, keluar, stock, idtransaksi, idbarang) 
    VALUES (NOW(), 2, NEW.jumlah_terima, 0, stock_now, NEW.idpenerimaan, NEW.barang_idbarang);
END $$
DELIMITER ;


-- -----------------------------------------------------
-- TRIGGER KARTU STOK RETUR
-- -----------------------------------------------------
DELIMITER $$
CREATE TRIGGER barang_keluar AFTER INSERT ON detail_retur 
FOR EACH ROW 
BEGIN
    DECLARE idbarang_retur INT;
    DECLARE old_max_id INT;
    DECLARE stock_lama INT;
    DECLARE stock_now INT;
    
    SELECT barang_idbarang INTO idbarang_retur
    FROM detail_penerimaan
    WHERE iddetail_penerimaan = NEW.iddetail_penerimaan;
    SELECT MAX(idkartu_stok) INTO old_max_id FROM kartu_stok WHERE idbarang = idbarang_retur;
    SELECT stock INTO stock_lama FROM kartu_stok WHERE idkartu_stok = old_max_id;

    SET stock_now = COALESCE(stock_lama, 0) - NEW.jumlah;

    INSERT INTO kartu_stok (created_at, jenis_transaksi, masuk, keluar, stock, idtransaksi, idbarang) 
    VALUES (NOW(), 2, 0,NEW.jumlah, stock_now, NEW.idretur, idbarang_retur);
END $$
DELIMITER ;


DROP TABLE`badan_hukum`;
DROP TABLE `barang`;
DROP TABLE `detail_penerimaan`;
DROP TABLE `detail_pengadaan`;
DROP TABLE `detail_penjualan`;
DROP TABLE `detail_retur`;
DROP TABLE `jenis_barang`;
DROP TABLE `kartu_stok`;
DROP TABLE `margin_penjualan`;
DROP TABLE `penerimaan`;
DROP TABLE `pengadaan`;
DROP TABLE `penjualan`;
DROP TABLE `retur`;
DROP TABLE `role`;
DROP TABLE `satuan`;
DROP TABLE `user_table`;
DROP TABLE `vendor`;



DROP PROCEDURE `tambah_retur`;
DROP TRIGGER `barang_masuk`;
DROP PROCEDURE `tambah_pengadaan`;
DROP PROCEDURE `TerimaPengadaan`;
DROP VIEW `v_stok_barang`;
DROP FUNCTION `fn_hitung_grand_total`;
DROP FUNCTION `fn_hitung_ppn`;
DROP TRIGGER `barang_keluar`;