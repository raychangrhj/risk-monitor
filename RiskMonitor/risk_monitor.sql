-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2017 at 11:49 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `risk_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(4) NOT NULL,
  `admin_id` int(4) NOT NULL,
  `sub_admin_id` int(11) NOT NULL,
  `company_type` varchar(20) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `admin_id`, `sub_admin_id`, `company_type`, `company_name`, `address`, `vat`, `zip_code`, `website`) VALUES
(1, 0, 0, 'AMB', 'amb-company', 'amb-address', 'amb-vat', 'amb-zipcode', 'amb-website');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_intermediary`
--

CREATE TABLE `pdf_intermediary` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `month_id` int(4) NOT NULL,
  `intermediary` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_month`
--

CREATE TABLE `pdf_month` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `monthYear` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_summary`
--

CREATE TABLE `pdf_summary` (
  `id` int(4) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `admin_id` int(4) NOT NULL,
  `sub_admin_id` int(4) NOT NULL,
  `company_id` int(4) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `dataType` varchar(20) NOT NULL,
  `candidate` varchar(100) NOT NULL,
  `property1` varchar(50) NOT NULL,
  `property2` varchar(50) NOT NULL,
  `taxCode` varchar(50) NOT NULL,
  `censusCode` varchar(50) NOT NULL,
  `requestDate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table0`
--

CREATE TABLE `pdf_table0` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `EMPTY` varchar(50) NOT NULL,
  `Accordato` varchar(20) NOT NULL,
  `AccordatoOperativo` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table1`
--

CREATE TABLE `pdf_table1` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `EMPTY` varchar(50) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table2`
--

CREATE TABLE `pdf_table2` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `EMPTY` varchar(50) NOT NULL,
  `ValoreGaranzia` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table3`
--

CREATE TABLE `pdf_table3` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `DurataOriginaria` varchar(20) NOT NULL,
  `DurataResidua` varchar(20) NOT NULL,
  `Divisa` varchar(20) NOT NULL,
  `ImportExport` varchar(20) NOT NULL,
  `TipoAttivita` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `TipoGaranzia` varchar(20) NOT NULL,
  `RuoloAffidato` varchar(20) NOT NULL,
  `Accordato` varchar(20) NOT NULL,
  `AccordatoOperativo` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL,
  `SaldoMedio` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table4`
--

CREATE TABLE `pdf_table4` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `Divisa` varchar(20) NOT NULL,
  `ImportExport` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `TipoGaranzia` varchar(20) NOT NULL,
  `RuoloAffidato` varchar(20) NOT NULL,
  `Accordato` varchar(20) NOT NULL,
  `AccordatoOperativo` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL,
  `SaldoMedio` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table5`
--

CREATE TABLE `pdf_table5` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `Divisa` varchar(20) NOT NULL,
  `ImportExport` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `Accordato` varchar(20) NOT NULL,
  `AccordatoOperativo` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table6`
--

CREATE TABLE `pdf_table6` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Garante` varchar(100) NOT NULL,
  `ValoreGaranzia` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table7`
--

CREATE TABLE `pdf_table7` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `TipoGaranzia` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table8`
--

CREATE TABLE `pdf_table8` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `Garantito` varchar(50) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `TipoGaranzia` varchar(20) NOT NULL,
  `ValoreGaranzia` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table9`
--

CREATE TABLE `pdf_table9` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `DurataResidua` varchar(20) NOT NULL,
  `Divisa` varchar(20) NOT NULL,
  `ImportExport` varchar(20) NOT NULL,
  `TipoAttivita` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `TipoGaranzia` varchar(20) NOT NULL,
  `RuoloAffidato` varchar(20) NOT NULL,
  `Accordato` varchar(20) NOT NULL,
  `AccordatoOperativo` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL,
  `ImportoGarantito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table10`
--

CREATE TABLE `pdf_table10` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `Importo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table11`
--

CREATE TABLE `pdf_table11` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `TipoAttivita` varchar(20) NOT NULL,
  `Cedente` varchar(50) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `Importo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table12`
--

CREATE TABLE `pdf_table12` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `TipologiaDiFinanziamento` varchar(50) NOT NULL,
  `DataEvento` varchar(20) NOT NULL,
  `TipoEvento` varchar(50) NOT NULL,
  `EventoCancellato` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table13`
--

CREATE TABLE `pdf_table13` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `TipoAttivita` varchar(20) NOT NULL,
  `Cessionario` varchar(50) NOT NULL,
  `FenomenoCorrelato` varchar(20) NOT NULL,
  `Importo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table14`
--

CREATE TABLE `pdf_table14` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `EMPTY` varchar(50) NOT NULL,
  `Importo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table15`
--

CREATE TABLE `pdf_table15` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(80) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `Divisa` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `TipoGaranzia` varchar(20) NOT NULL,
  `Accordato` varchar(20) NOT NULL,
  `AccordatoOperativo` varchar(20) NOT NULL,
  `Utilizzato` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table16`
--

CREATE TABLE `pdf_table16` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `intermediary_id` int(4) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Localizzazione` varchar(20) NOT NULL,
  `DurataResidua` varchar(20) NOT NULL,
  `Divisa` varchar(20) NOT NULL,
  `ImportExport` varchar(20) NOT NULL,
  `StatoRapporto` varchar(20) NOT NULL,
  `Importo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_variable_name`
--

CREATE TABLE `pdf_variable_name` (
  `id` int(4) NOT NULL,
  `pdf_id` int(4) NOT NULL,
  `VARIABILI` varchar(50) NOT NULL,
  `Codice` varchar(20) NOT NULL,
  `Descrizione` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_credit`
--

CREATE TABLE `transaction_credit` (
  `id` int(4) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `super_admin_id` int(4) NOT NULL,
  `admin_id` int(4) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `credits` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `admin_id` int(4) NOT NULL,
  `sub_admin_id` int(4) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `company_id` int(4) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL,
  `active_status` varchar(10) NOT NULL,
  `credits` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `admin_id`, `sub_admin_id`, `user_type`, `first_name`, `last_name`, `user_name`, `password`, `company_id`, `company_name`, `phone_number`, `email`, `image`, `active_status`, `credits`) VALUES
(1, 0, 0, 'AMB', 'amb', 'amb', 'ambuser', '74b87337454200d4d33f80c4663dc5e5', 1, '', '12345678', 'amb@a.com', '', 'ACTIVE', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_intermediary`
--
ALTER TABLE `pdf_intermediary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_month`
--
ALTER TABLE `pdf_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_summary`
--
ALTER TABLE `pdf_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table0`
--
ALTER TABLE `pdf_table0`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table1`
--
ALTER TABLE `pdf_table1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table2`
--
ALTER TABLE `pdf_table2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table3`
--
ALTER TABLE `pdf_table3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table4`
--
ALTER TABLE `pdf_table4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table5`
--
ALTER TABLE `pdf_table5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table6`
--
ALTER TABLE `pdf_table6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table7`
--
ALTER TABLE `pdf_table7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table8`
--
ALTER TABLE `pdf_table8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table9`
--
ALTER TABLE `pdf_table9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table10`
--
ALTER TABLE `pdf_table10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table11`
--
ALTER TABLE `pdf_table11`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table12`
--
ALTER TABLE `pdf_table12`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table13`
--
ALTER TABLE `pdf_table13`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table14`
--
ALTER TABLE `pdf_table14`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table15`
--
ALTER TABLE `pdf_table15`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_table16`
--
ALTER TABLE `pdf_table16`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_variable_name`
--
ALTER TABLE `pdf_variable_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_credit`
--
ALTER TABLE `transaction_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pdf_intermediary`
--
ALTER TABLE `pdf_intermediary`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_month`
--
ALTER TABLE `pdf_month`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_summary`
--
ALTER TABLE `pdf_summary`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table0`
--
ALTER TABLE `pdf_table0`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table1`
--
ALTER TABLE `pdf_table1`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table2`
--
ALTER TABLE `pdf_table2`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table3`
--
ALTER TABLE `pdf_table3`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table4`
--
ALTER TABLE `pdf_table4`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table5`
--
ALTER TABLE `pdf_table5`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table6`
--
ALTER TABLE `pdf_table6`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table7`
--
ALTER TABLE `pdf_table7`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table8`
--
ALTER TABLE `pdf_table8`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table9`
--
ALTER TABLE `pdf_table9`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table10`
--
ALTER TABLE `pdf_table10`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table11`
--
ALTER TABLE `pdf_table11`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table12`
--
ALTER TABLE `pdf_table12`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table13`
--
ALTER TABLE `pdf_table13`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table14`
--
ALTER TABLE `pdf_table14`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table15`
--
ALTER TABLE `pdf_table15`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_table16`
--
ALTER TABLE `pdf_table16`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_variable_name`
--
ALTER TABLE `pdf_variable_name`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_credit`
--
ALTER TABLE `transaction_credit`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
