
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- propel_brand
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `propel_brand`;

CREATE TABLE `propel_brand`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
