
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- cities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `county_id` int(11) unsigned,
    PRIMARY KEY (`id`),
    INDEX `county_id` (`county_id`),
    CONSTRAINT `cities_ibfk_1`
        FOREIGN KEY (`county_id`)
        REFERENCES `counties` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city_places
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city_places`;

CREATE TABLE `city_places`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `city_id` int(11) unsigned,
    `place_id` int(11) unsigned,
    PRIMARY KEY (`id`),
    INDEX `city_id` (`city_id`),
    INDEX `place_id` (`place_id`),
    CONSTRAINT `city_places_ibfk_1`
        FOREIGN KEY (`city_id`)
        REFERENCES `cities` (`id`),
    CONSTRAINT `city_places_ibfk_2`
        FOREIGN KEY (`place_id`)
        REFERENCES `places` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city_railroads
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city_railroads`;

CREATE TABLE `city_railroads`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `city_id` int(10) unsigned,
    `railroad_id` int(10) unsigned,
    PRIMARY KEY (`id`),
    INDEX `city_id` (`city_id`),
    INDEX `railroad_id` (`railroad_id`),
    CONSTRAINT `city_railroads_ibfk_1`
        FOREIGN KEY (`city_id`)
        REFERENCES `cities` (`id`),
    CONSTRAINT `city_railroads_ibfk_2`
        FOREIGN KEY (`railroad_id`)
        REFERENCES `railroads` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city_road_aliases
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city_road_aliases`;

CREATE TABLE `city_road_aliases`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `city_road_id` int(10) unsigned,
    `alias` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `city_road_id` (`city_road_id`),
    CONSTRAINT `city_road_aliases_ibfk_1`
        FOREIGN KEY (`city_road_id`)
        REFERENCES `city_roads` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city_roads
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city_roads`;

CREATE TABLE `city_roads`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `road_id` int(11) unsigned,
    `city_id` int(11) unsigned,
    PRIMARY KEY (`id`),
    INDEX `road_id` (`road_id`),
    INDEX `city_id` (`city_id`),
    CONSTRAINT `city_roads_ibfk_2`
        FOREIGN KEY (`road_id`)
        REFERENCES `roads` (`id`),
    CONSTRAINT `city_roads_ibfk_3`
        FOREIGN KEY (`city_id`)
        REFERENCES `cities` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- counties
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `counties`;

CREATE TABLE `counties`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100),
    `state_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `state_id` (`state_id`),
    CONSTRAINT `counties_ibfk_1`
        FOREIGN KEY (`state_id`)
        REFERENCES `states` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- place_sub_types
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `place_sub_types`;

CREATE TABLE `place_sub_types`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- place_types
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `place_types`;

CREATE TABLE `place_types`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- places
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `places`;

CREATE TABLE `places`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `place` VARCHAR(255),
    `place_type` int(11) unsigned,
    `place_sub_type` int(11) unsigned,
    PRIMARY KEY (`id`),
    INDEX `place_type` (`place_type`),
    INDEX `place_sub_type` (`place_sub_type`),
    CONSTRAINT `places_ibfk_2`
        FOREIGN KEY (`place_type`)
        REFERENCES `place_types` (`id`),
    CONSTRAINT `places_ibfk_3`
        FOREIGN KEY (`place_sub_type`)
        REFERENCES `place_sub_types` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- railroads
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `railroads`;

CREATE TABLE `railroads`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `railroad` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- road_types
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `road_types`;

CREATE TABLE `road_types`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(50),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- roads
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `roads`;

CREATE TABLE `roads`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `type` int(11) unsigned,
    PRIMARY KEY (`id`),
    INDEX `type` (`type`),
    CONSTRAINT `roads_ibfk_1`
        FOREIGN KEY (`type`)
        REFERENCES `road_types` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- states
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `states`;

CREATE TABLE `states`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `state` VARCHAR(50),
    `abbrevation` VARCHAR(2),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
