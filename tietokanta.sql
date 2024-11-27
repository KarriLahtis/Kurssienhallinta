SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `kurssi` (
  `ID` int(12) NOT NULL,
  `Nimi` varchar(55) NOT NULL,
  `Kuvaus` text NOT NULL,
  `Alkupaiva` date NOT NULL,
  `Loppupaiva` date NOT NULL,
  `Opettaja` int(12) NOT NULL,
  `Tila` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kurssi` (`ID`, `Nimi`, `Kuvaus`, `Alkupaiva`, `Loppupaiva`, `Opettaja`, `Tila`) VALUES
(2, 'Äidinkieli', 'Suomenkielen Opetusta', '2024-09-04', '2024-11-30', 2, 1),
(3, 'Matikka', 'Matematiikan Peruslaskuja', '2024-09-03', '2024-11-30', 1, 2);

CREATE TABLE `kurssikirjautuminen` (
  `ID` int(12) NOT NULL,
  `Opiskelija` int(12) NOT NULL,
  `Kurssi` int(12) NOT NULL,
  `Kirjautumis_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kurssikirjautuminen` (`ID`, `Opiskelija`, `Kurssi`, `Kirjautumis_Date`) VALUES
(1, 1, 2, '2024-11-27 13:58:27'),
(2, 1, 3, '2024-11-27 13:58:27');

CREATE TABLE `opettaja` (
  `ID` int(12) NOT NULL,
  `Etunimi` varchar(20) NOT NULL,
  `Sukunimi` varchar(20) NOT NULL,
  `Aine` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `opettaja` (`ID`, `Etunimi`, `Sukunimi`, `Aine`) VALUES
(1, 'Bogdan', 'Udrescu', 'Matikka'),
(2, 'Mikko', 'Suomalainen', 'Äidinkieli');

CREATE TABLE `opiskelija` (
  `ID` int(12) NOT NULL,
  `Etunimi` varchar(20) NOT NULL,
  `Sukunimi` varchar(20) NOT NULL,
  `Syntymapaiva` date NOT NULL,
  `Vuosikurssi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `opiskelija` (`ID`, `Etunimi`, `Sukunimi`, `Syntymapaiva`, `Vuosikurssi`) VALUES
(1, 'Karri', 'Lahti', '2005-11-03', 3);

CREATE TABLE `tila` (
  `ID` int(12) NOT NULL,
  `Nimi` varchar(10) NOT NULL,
  `Kapasiteetti` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tila` (`ID`, `Nimi`, `Kapasiteetti`) VALUES
(1, 'A100', 1),
(2, 'C100', 2);


ALTER TABLE `kurssi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Opettaja` (`Opettaja`),
  ADD KEY `Tila` (`Tila`);

ALTER TABLE `kurssikirjautuminen`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Opiskelija` (`Opiskelija`,`Kurssi`),
  ADD KEY `Kurssi` (`Kurssi`);

ALTER TABLE `opettaja`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `opiskelija`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `tila`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `kurssi`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `kurssikirjautuminen`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `opettaja`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `opiskelija`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tila`
  MODIFY `ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `kurssi`
  ADD CONSTRAINT `kurssi_ibfk_1` FOREIGN KEY (`Opettaja`) REFERENCES `opettaja` (`ID`),
  ADD CONSTRAINT `kurssi_ibfk_2` FOREIGN KEY (`Tila`) REFERENCES `tila` (`ID`);

ALTER TABLE `kurssikirjautuminen`
  ADD CONSTRAINT `kurssikirjautuminen_ibfk_1` FOREIGN KEY (`Kurssi`) REFERENCES `kurssi` (`ID`),
  ADD CONSTRAINT `kurssikirjautuminen_ibfk_2` FOREIGN KEY (`Opiskelija`) REFERENCES `opiskelija` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
