-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cama
-- ------------------------------------------------------
-- Server version	5.7.33-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping events for database 'cama'
--

--
-- Dumping routines for database 'cama'
--
/*!50003 DROP FUNCTION IF EXISTS `fn_attachment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_attachment`(
	`p_param` json,
	`p_user` VARCHAR(50),
    id int
) RETURNS varchar(15) CHARSET utf8
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE maid INT DEFAULT 0;
	DECLARE attachmentid INT DEFAULT 0;
	DECLARE atpath varchar(4000);
	DECLARE filename varchar(150);
	DECLARE attachtype varchar(150);
	DECLARE atdetail text;
	DECLARE orginalfilename varchar(150);
	DECLARE actioncode varchar(150);
	DECLARE ext varchar(150);
	DECLARE l_count int; 
    
	WHILE i < JSON_LENGTH(p_param) DO    
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].attachmentid')))) INTO attachmentid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].atpath')))) INTO atpath;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].filename')))) INTO filename;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].attachtype')))) INTO attachtype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].atdetail')))) INTO atdetail;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].orgname')))) INTO orginalfilename; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ext')))) INTO ext; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
		
		if actioncode = 'new' then
			-- select count(*) into l_count from cm_attachment where at_ma_id = id and at_path = atpath;
          --  if l_count = 0 then
				insert into cm_attachment(at_linkid, at_attachtype_id, at_name, at_detail, at_oringinalfilename, at_fileextention,
				at_path,at_createby, at_createdate, at_updateby, at_updatedate)
				values(id, attachtype, filename, atdetail, orginalfilename, ext, atpath,
                p_user, now(), p_user, now());
           -- end if;
        end if;
        
        if actioncode = 'delete' then   
			delete from cm_attachment where at_id = attachmentid;
		end if;
		
		SELECT i + 1 INTO i;
	END WHILE;
	RETURN null;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `fn_check_digit` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_check_digit`(p_param BIGINT) RETURNS int(11)
BEGIN
	declare res_arr BIGINT default 0;
	declare a BIGINT default 0;
	declare b BIGINT default 0;
	declare temp BIGINT default 0;
	declare c BIGINT default 0;
	declare d BIGINT default 0;
	declare i BIGINT default 0;
	declare len int default 0;
    declare accno varchar(12);
        

 
 set len = cast(LENGTH(p_param)  as SIGNED INTEGER);
	
 
    WHILE i < len DO
    
        SET i = i + 1;
        set a = 86 - i;     
        set b = mid(p_param, i+1, 1)  * a;
        
        set c = c + b;
         
    END WHILE;
   
	set a = (c / 9);
    set a = a * 9;
    set b = c - a;
    set d = 9 - abs(b);
    
    
RETURN d;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `fn_remisi_inspection` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_remisi_inspection`(
	`p_param` json,
	`p_user` VARCHAR(50),
	`p_id` int
) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE l_id INT DEFAULT 0;
	DECLARE l_instype_id varchar(15);
	DECLARE l_insfind1 varchar(30) ;
	DECLARE l_insfind2 varchar(55);
	DECLARE l_insfind3 varchar(55);
	DECLARE l_insfind4 varchar(55);
	DECLARE l_insfind5 varchar(55);
	DECLARE l_review TEXT;
	DECLARE l_officer varchar(150);
	DECLARE l_officerdate varchar(150);
	DECLARE operation int default 0;
	DECLARE actioncode varchar(10);


	WHILE i < JSON_LENGTH(p_param) DO
		
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].insdate')))) INTO l_officerdate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].id')))) INTO l_id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].instype')))) INTO l_instype_id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].insofficer')))) INTO l_officer;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].review')))) INTO l_review;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reason1')))) INTO  l_insfind1;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reason2')))) INTO  l_insfind2;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reason3')))) INTO  l_insfind3; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reason4')))) INTO  l_insfind4; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reason5')))) INTO  l_insfind5;
		
	
	
	 
		if actioncode = 'new' then
			
				INSERT INTO  `cm_remisi_inspection`
				(`ri_rg_id`,`ri_instype_id`,`ri_insfind1`,`ri_insfind2`,`ri_insfind3`,
				`ri_insfind4`,`ri_insfind5`,`ri_review`,`ri_insofficer`,`ri_insofficerdate`,`ri_createby`,`ri_createat`)
				VALUES(p_id, l_instype_id, l_insfind1, l_insfind2, l_insfind3, l_insfind4, l_insfind5, l_review,
				 l_officer, l_officerdate, p_user,now());
		
		end if;
				
		SELECT i + 1 INTO i;
	END WHILE;

RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_additional` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_additional`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
    DECLARE addadditionalid INT DEFAULT 0;
	DECLARE l_desc varchar(30);
	DECLARE area varchar(55);
	DECLARE rate varchar(30);
	DECLARE grossvalue varchar(55);
	DECLARE roundvalue varchar(30);
	DECLARE actioncode varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].desc')))) INTO l_desc;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].area')))) INTO area;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].rate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossvalue')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundvalue')))) INTO roundvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].addadditionalid')))) INTO addadditionalid;
        
		set area = replace(area, ',', '');
		set rate = replace(rate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
		set roundvalue = replace(roundvalue, ',', '');
        
        if actioncode = 'new' then 
			insert into cm_appln_val_additional(vad_vd_id, vad_desc, vad_area, vad_rate, vad_grossvalue,
            vad_roundnetvalue,vad_createby, vad_createdate, vad_updateby, vad_updatedate)
            value(prop_id,l_desc,area,rate,grossvalue,roundvalue,p_user, now(),p_user, now());
        end if;
        
        if actioncode = 'update' then 
			update cm_appln_val_additional set  vad_desc = l_desc, vad_area = area
            , vad_rate = rate, vad_grossvalue = grossvalue,
            vad_roundnetvalue = roundvalue, vad_updateby = p_user, vad_updatedate = now()
            where vad_id = addadditionalid;
        end if;
        
        if actioncode = 'delete' then 
			delete from cm_appln_val_additional where vad_id = addadditionalid;
        end if;
        
        
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_allowance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_allowance`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
    DECLARE id INT DEFAULT 0;
	DECLARE calmethod varchar(30);
	DECLARE percentage varchar(55);
	DECLARE grossvalue varchar(30);
	DECLARE bldgallowanceid varchar(55);
	DECLARE actioncode varchar(55);
	DECLARE allwancedes varchar(255);
	DECLARE calmethodid varchar(5);
	DECLARE bldgid int(55);
	DECLARE allowancetypeid varchar(5);
    
    WHILE i < JSON_LENGTH(p_param) DO
		
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgallowanceid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].calmethod')))) INTO calmethod;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].percentage')))) INTO percentage;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossvalue')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].desc')))) INTO allwancedes;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].sno')))) INTO actioncode;
        select tdi_key into calmethodid from tbdefitems where tdi_td_name = 'ALLOWANCECALMETHOD' and tdi_value = calmethod;
		
        set percentage = replace(percentage, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        
		select tdi_key into allowancetypeid from tbdefitems where tdi_td_name = 'ALLOWANCETYPE' 
        and tdi_value = SPLIT_STR(allwancedes, ',', 2);
		
        if actioncode = 'New' then 
			insert into cm_appln_val_bldgallowances(vbal_vb_id,vbal_allowancetype_id, vbal_calcmethod_id, vbal_drivevalue,
            vbal_grossallowancevalue, vbal_roundgrossallowancevalue,
            vbal_createby,vbal_createdate, vbal_updateby, vbal_updatedate)
            value(bldgid,allowancetypeid,calmethodid,percentage,grossvalue,grossvalue,p_user, now(),p_user, now());
        end if;
        
        if actioncode = 'update' then 
			update cm_appln_val_bldgallowances set  vbal_calcmethod_id = calmethodid, vbal_drivevalue = percentage
            , vbal_grossallowancevalue = grossvalue, vbal_roundgrossallowancevalue = grossvalue,
            vbal_updateby = p_user, vbal_updatedate = now()
            where vbal_id = id;
        end if;
        
        if actioncode = 'Deleted' then 
			delete from cm_appln_val_bldgallowances where  vbal_id = id;
        end if;
        
       
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_bldg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldg`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE bldgid int;
	DECLARE allowancevalue varchar(30);
	DECLARE depvalue varchar(55);
	DECLARE netbldgvalue varchar(30);
	DECLARE roundbldgvalue varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].allowancevalue')))) INTO allowancevalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].depvalue')))) INTO depvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netbldgvalue')))) INTO netbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundbldgvalue')))) INTO roundbldgvalue;
        
		set allowancevalue = replace(allowancevalue, ',', '');
		set depvalue = replace(depvalue, ',', '');
		set netbldgvalue = replace(netbldgvalue, ',', '');
		set roundbldgvalue = replace(roundbldgvalue, ',', '');
        
        update cm_appln_val_bldg set vb_netnt = netbldgvalue, vb_roundnetnt = roundbldgvalue,
        vb_grossallowancevalue = allowancevalue , vb_depreciationvalue = depvalue
        where vb_id = bldgid;
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_bldgarea` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldgarea`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE rate  varchar(30);
	DECLARE grossvalue varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arearate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossareavalue')))) INTO grossvalue;
        
		set rate = replace(rate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        
        update cm_appln_val_bldgarea set vba_bldgrate = rate,
        vba_grossareavalue = grossvalue, vba_updateby = p_user, vba_updatedate = now()
        where vba_id = id;
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_lot` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_lot`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE lotid int;
	DECLARE netvalue varchar(30);
	DECLARE roundvalue varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotid')))) INTO lotid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netvalue')))) INTO netvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundvalue')))) INTO roundvalue;
        
		set netvalue = replace(netvalue, ',', '');
		set roundvalue = replace(roundvalue, ',', '');
        
        update cm_appln_val_lot set vl_grosslandvalue = netvalue, vl_roundnetlandvalue = roundvalue
        where vl_id = lotid;
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_lotarea` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_lotarea`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE rate varchar(30);
	DECLARE calculatedrate varchar(55);
	DECLARE grossvalue varchar(30);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotareaid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].rate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].calculatedrate')))) INTO calculatedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossvalue')))) INTO grossvalue;
        
		set rate = replace(rate, ',', '');
		set calculatedrate = replace(calculatedrate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        
        update cm_appln_val_lotarea set vla_landrate = rate, vla_discountrate = calculatedrate,
        vla_grossareavalue = grossvalue , vla_updateby = p_user, vla_updatedate = now()
        where vla_id = id;
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_lot_v2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_lot_v2`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE lotid int;
	DECLARE netvalue varchar(30);
	DECLARE roundvalue varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotid')))) INTO lotid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netvalue')))) INTO netvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundvalue')))) INTO roundvalue;
        
		set netvalue = replace(netvalue, ',', '');
		set roundvalue = replace(roundvalue, ',', '');
        
        insert into cm_appln_val_lot(vl_vd_id, vl_lotcode_id, vl_no, vl_altno, vl_roundnetlandvalue, vl_grosslandvalue)
        
        select al_vd_id, al_lotcode_id, al_no, al_altno, netvalue, roundvalue
		from  cm_appln_lot,cm_appln_parameter, cm_masterlist
		where al_vd_id = vd_id and ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_va_id = p_valuationbasket;
        
        /*&update cm_appln_val_lot set vl_grosslandvalue = netvalue, vl_roundnetlandvalue = roundvalue
        where vl_id = lotid;*/
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `manualval_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_tax`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE grossvalue varchar(20);
	DECLARE valuedescretion varchar(20);
	DECLARE proposednt varchar(20);
	DECLARE proposedrate varchar(20);
	DECLARE calculatedrate varchar(20);
	DECLARE proposedtax varchar(20);
	DECLARE approvednt varchar(20);
	DECLARE approvedrate varchar(20);
	DECLARE adjustment varchar(20);
	DECLARE approvedtax varchar(20);
	DECLARE taxdriverate varchar(20);
	DECLARE taxdrivevalue varchar(20);
	DECLARE notes text;
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxvaluerdiscretion')))) INTO valuedescretion;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxgrossnt')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxproposednt')))) INTO proposednt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxproposedrate')))) INTO proposedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxcalculaterate')))) INTO calculatedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxproposedtax')))) INTO proposedtax;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxapprovednt')))) INTO approvednt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxapprovedrate')))) INTO approvedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxadjustment')))) INTO adjustment;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxapprovedtax')))) INTO approvedtax;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxnotes')))) INTO notes;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxdriverate')))) INTO taxdriverate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxdrivevalue')))) INTO taxdrivevalue;
        
        set grossvalue = replace(grossvalue, ',', '');
        set valuedescretion = replace(valuedescretion, ',', '');
        set proposedrate = replace(proposedrate, ',', '');
        set calculatedrate = replace(calculatedrate, ',', '');
        set proposedtax = replace(proposedtax, ',', '');
        set approvednt = replace(approvednt, ',', '');
        set approvedrate = replace(approvedrate, ',', '');
        set adjustment = replace(adjustment, ',', '');
        set approvedtax = replace(approvedtax, ',', '');
        set proposednt = replace(proposednt, ',', '');
        set taxdrivevalue = replace(taxdrivevalue, ',', '');
        set taxdriverate = replace(taxdriverate, ',', '');
        
        update cm_appln_val_tax set vt_grossvalue = grossvalue, 
			vt_valuedescretion = valuedescretion, 
			vt_proposednt = proposednt, 
			vt_proposedrate = proposedrate, 
			vt_calculatedrate = calculatedrate, 
			vt_proposedtax = proposedtax, 
			vt_approvednt = approvednt, 
			vt_approvedrate = approvedrate, 
			vt_adjustment = adjustment, 
			vt_approvedtax = approvedtax, 
			vt_note = notes, vt_updateby = p_user, vt_updatedate = now(),
            vt_derivedrate = ifnull(taxdriverate,0), vt_derivedvalue = ifnull(taxdrivevalue,0)
        where vt_vd_id = prop_id;
          update cm_appln_valdetl set vd_approvalstatus_id = '09' where vd_id = prop_id;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `mass_val_lot` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `mass_val_lot`(p_valuationbasket int, p_tonebasket int) RETURNS int(11)
BEGIN
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_vd_id int;
DECLARE l_subzone varchar(5);
DECLARE l_bldgtype varchar(5);
DECLARE l_proptype varchar(5);
DECLARE l_propcategory varchar(5);
DECLARE l_state varchar(2);
DECLARE l_mbp varchar(20);
DECLARE l_ptss varchar(3);
DECLARE l_lotcode_id varchar(2);
DECLARE l_no varchar(15);
DECLARE l_altno varchar(15);
DECLARE l_titletype_id varchar(3);
DECLARE l_titleno varchar(8);
DECLARE l_alttitleno varchar(8);
DECLARE l_size float(15,4);
DECLARE l_sizeunit_id varchar(2);
DECLARE l_landcondition_id varchar(4);
DECLARE l_landposision_id varchar(4);
DECLARE l_roadtype_id varchar(3);
DECLARE l_roadcategory_id varchar(3);
DECLARE l_landuse_id varchar(4);
DECLARE l_excd text;
DECLARE l_rtit text;
DECLARE l_tenuretype_id varchar(1);
DECLARE l_tenureperiod int(3);
DECLARE l_startdate date;
DECLARE l_expireddate date;
DECLARE l_activeind_id varchar(4); 
DECLARE landrate float;
DECLARE l_standardarea float;
DECLARE l_nextarea float;
DECLARE l_maxlevel float;
DECLARE l_grossvalue float;
DECLARE l_roundnetareavalue float;
DECLARE l_totalgrossarea float;
DECLARE l_totalroundnetarea float;
DECLARE l_discount float default 20;
declare l_count int default 1;
declare l_lotid int default 0;
 
 DEClARE lot_cursor CURSOR FOR 
 select vd_id,ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id,
ap_propertytype_id, al_state, al_lotcode_id, al_no, al_altno, al_titletype_id,
al_titleno, al_alttitleno, al_size, al_sizeunit_id, al_landcondition_id, al_landposision_id,
al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id, al_tenureperiod,
al_startdate, al_expireddate, al_activeind_id
from cm_appln_valdetl, cm_appln_lot,cm_appln_parameter, cm_masterlist
where al_vd_id = vd_id and ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_va_id = p_valuationbasket;
 DECLARE CONTINUE HANDLER 
 FOR NOT FOUND SET v_finished = 1;
    
    OPEN lot_cursor;
        
get_lot: LOOP
 
 FETCH lot_cursor INTO l_vd_id, l_subzone, l_bldgtype,  l_propcategory, l_proptype, l_state,
l_lotcode_id, l_no, l_altno, l_titletype_id, l_titleno,
l_alttitleno, l_size, l_sizeunit_id, l_landcondition_id, l_landposision_id,
l_roadtype_id, l_roadcategory_id, l_landuse_id, l_excd, l_rtit,
l_tenuretype_id, l_tenureperiod, l_startdate, l_expireddate, l_activeind_id;
 
 IF v_finished = 1 THEN 
 LEAVE get_lot;
 END IF;
 select tland_value into landrate from cm_tone_land where tland_ishasbuilding_id = l_bldgtype and
 tland_subzon_id = l_subzone and  tland_proptype_id = l_proptype and tland_tone_id = p_tonebasket;
 
 select tstand_standartarea, tstand_nextarea, tstand_maxlevel into l_standardarea,
 l_nextarea, l_maxlevel from cm_tone_land_standart 
 where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype and tstand_tone_id = p_tonebasket;
 
 INSERT INTO `cm_appln_val_lot`(`vl_id`) VALUES (NULL);
 SELECT LAST_INSERT_ID() into l_lotid;
 
 if l_standardarea <=  l_size then 
	set l_grossvalue = l_size * landrate * (l_discount / 100);
    set l_roundnetareavalue =  FLOOR(l_grossvalue);
    set l_totalgrossarea = l_grossvalue;
    set l_totalroundnetarea = l_roundnetareavalue;
    INSERT INTO `cm_appln_val_lotarea`
(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,`vla_landrate`,
`vla_discountrate`,`vla_grossareavalue`,`vla_roundnetareavalue`,
`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
VALUES
(l_lotid, 0,'Standart Area',l_size,landrate,l_discount, l_grossvalue,l_roundnetareavalue,
'admin', now(), 'admin', now() );
 else
	set l_grossvalue = l_standardarea * landrate *(l_discount / 100);
    set l_roundnetareavalue =  FLOOR(l_grossvalue);
    set l_size = l_size - l_standardarea;
    set l_totalgrossarea = l_totalgrossarea + l_grossvalue;
    set l_totalroundnetarea = l_totalroundnetarea + l_roundnetareavalue;
    INSERT INTO `cm_appln_val_lotarea`
(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,`vla_landrate`,
`vla_discountrate`,`vla_grossareavalue`,`vla_roundnetareavalue`,
`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
VALUES
(l_lotid, 0,concat('Standart Area ',l_count),l_size,landrate,l_discount, l_grossvalue,l_roundnetareavalue,
'admin', now(), 'admin', now() );
	standardarea_loop: LOOP		
		IF l_size = 0 THEN 
			LEAVE standardarea_loop;
		END IF;		
		set l_size = l_size - l_nextarea;
        set l_grossvalue = l_nextarea * landrate *(l_discount / 100);
		set l_roundnetareavalue =  FLOOR(l_grossvalue);
		set l_totalgrossarea = l_totalgrossarea + l_grossvalue;
		set l_totalroundnetarea = l_totalroundnetarea + l_roundnetareavalue;
        INSERT INTO `cm_appln_val_lotarea`
		(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,`vla_landrate`,
		`vla_discountrate`,`vla_grossareavalue`,`vla_roundnetareavalue`,
		`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
		VALUES
		(l_lotid, 0,concat('Additional Area ',l_count),l_size,landrate,l_discount, l_grossvalue,l_roundnetareavalue,
		'admin', now(), 'admin', now() );
        if l_maxlevel = l_count then 
			set l_grossvalue = l_size * landrate *(l_discount / 100);
			set l_roundnetareavalue =  FLOOR(l_grossvalue);
			set l_totalgrossarea = l_totalgrossarea + l_grossvalue;
			set l_totalroundnetarea = l_totalroundnetarea + l_roundnetareavalue;
			set l_size = 0;
            INSERT INTO `cm_appln_val_lotarea`
			(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,`vla_landrate`,
			`vla_discountrate`,`vla_grossareavalue`,`vla_roundnetareavalue`,
			`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
			VALUES
			(l_lotid, 0,concat('Additional Area ',l_count),l_size,landrate,l_discount, l_grossvalue,l_roundnetareavalue,
			'admin', now(), 'admin', now() );
        end if;
        SET l_count = l_count + 1;
	END LOOP standardarea_loop;
    
     update `cm_appln_val_lot` SET
	`vl_vd_id` =l_vd_id ,`vl_lotcode_id`= l_lotcode_id,`vl_no`= l_no,
    `vl_altno`= l_altno,`vl_titletype_id`= l_titletype_id, `vl_titleno`= l_titleno,
    `vl_alttitleno`= l_alttitleno,`vl_size`= l_size,`vl_sizeunit_id`= l_sizeunit_id,
	`vl_standardarea`= l_standardarea,`vl_nextarea`= l_nextarea,`vl_maxlevel`= l_maxlevel,
    `vl_landcondition_id`= l_landcondition_id,`vl_landposision_id`= l_landposision_id,
    `vl_roadtype_id`= l_roadtype_id,`vl_roadcategory_id`= l_roadcategory_id,`vl_landuse_id`= l_landuse_id,
	`vl_tenuretype_id`= l_tenuretype_id,`vl_tenureperiod`= l_tenureperiod,`vl_startdate`= l_startdate,
    `vl_expireddate`= l_expireddate,`vl_grosslandvalue`= l_totalgrossarea,
	`vl_roundnetlandvalue`= l_totalroundnetarea,`vl_createby`= 'admin',
    `vl_createdate`= NOW(),`vl_updateby`= 'admin',`vl_updatedate`= NOW()
    WHERE `vl_id` = l_lotid;
	
    
 end if;
 
 
 END LOOP get_lot;
 
 CLOSE lot_cursor;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `new_function` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `new_function`() RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgnum varchar(15);
DECLARE bldg_id int;
DECLARE reffinfo varchar(50);
DECLARE artype varchar(55);
DECLARE arlevel varchar(55);
DECLARE arcate varchar(10);
DECLARE arzone varchar(10);
DECLARE aruse varchar(10);
DECLARE ardesc varchar(50);
DECLARE dimention varchar(50);
DECLARE arcnt int;
DECLARE uom varchar(5);
DECLARE totsize float;
DECLARE fltype varchar(5);
DECLARE walltype varchar(10);
DECLARE celingtype varchar(10);

DECLARE l_master_id int;
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reffinfo')))) INTO reffinfo;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].artype')))) INTO artype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arlevel')))) INTO arlevel;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcate')))) INTO arcate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arzone')))) INTO arzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].aruse')))) INTO aruse;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ardesc')))) INTO ardesc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dimention')))) INTO dimention;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcnt')))) INTO arcnt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].uom')))) INTO uom; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].totsize')))) INTO totsize; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].fltype')))) INTO fltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].walltype')))) INTO walltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].celingtype')))) INTO celingtype; 
    
    SELECT i + 1 INTO i;
    
    select bl_id into bldg_id from cm_bldg where bl_bldg_no = bldgnum;
    
    if bldgnum is not null then
		INSERT INTO `cm_bldgarea`
		(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
		`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
		`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`)
		VALUES (bldg_id, reffinfo, artype,  arlevel, arcate, arzone, aruse, ardesc, dimention, arcnt, 
		uom, totsize, fltype,
		walltype, celingtype, '', now(), '', now(), bldgtype);
    end if;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `previousNT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `previousNT`(p_vd_id int, p_accountnumber varchar(50)) RETURNS float
BEGIN
	DECLARE l_approvednt float default 0.0;
	select vt_approvednt into l_approvednt from cm_appln_valdetl 
    inner join cm_appln_val_tax on vt_vd_id = vd_id
    inner join cm_appln_val on va_id = vd_va_id
    inner join cm_appln_valterm on cm_appln_valterm.vt_id = cm_appln_val.va_vt_id
    where vd_id = (select max(vd_id) from cm_appln_valdetl where vd_id < p_vd_id and vd_accno = p_accountnumber)
    and vt_approvalstatus_id = '05'
    order by vd_id desc ; 
RETURN l_approvednt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `previousTAX` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `previousTAX`(p_vd_id int, p_accountnumber varchar(50)) RETURNS float
BEGIN
	DECLARE l_approvednt float default 0.0;
	select vt_approvedtax into l_approvednt from cm_appln_valdetl 
    inner join cm_appln_val_tax on vt_vd_id = vd_id
    inner join cm_appln_val on va_id = vd_va_id
    inner join cm_appln_valterm on cm_appln_valterm.vt_id = cm_appln_val.va_vt_id
    where vd_id = (select max(vd_id) from cm_appln_valdetl where vd_id < p_vd_id and vd_accno = p_accountnumber)
    and vt_approvalstatus_id = '05'
    order by vd_id desc ; 
RETURN l_approvednt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `pr_bldg_area_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pr_bldg_area_register`(
	`p_param` JSON
,
	`p_user` VARCHAR(50),
    p_type varchar(50),
    p_accountnumber varchar(15)

) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgnum varchar(15);
DECLARE bldg_id int;
DECLARE reffinfo varchar(50);
DECLARE artype varchar(55);
DECLARE arlevel varchar(55);
DECLARE arcate varchar(50);
DECLARE arzone varchar(50);
DECLARE aruse varchar(50);
DECLARE ardesc varchar(50);
DECLARE dimention varchar(50);
DECLARE arcnt int;
DECLARE size float;
DECLARE uom varchar(50);
DECLARE totsize float;
DECLARE fltype varchar(50);
DECLARE walltype varchar(50);
DECLARE celingtype varchar(50);
DECLARE artype_id varchar(5);
DECLARE arlevel_id varchar(5);
DECLARE arcate_id varchar(5);
DECLARE arzone_id varchar(5);
DECLARE bldgtypeid varchar(55);
DECLARE bldgcategoryid varchar(55);
DECLARE aruse_id varchar(5);
DECLARE fltype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE celingtype_id varchar(5);
DECLARE bldgaccnum varchar(15);
DECLARE size_id varchar(5);
DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgar_id int;
DECLARE operation int;
DECLARE actioncode varchar(10);

WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgaccnum')))) INTO bldgaccnum;
    
    
    if bldgnum <> '' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reffinfo')))) INTO reffinfo;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].artype')))) INTO artype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arlevel')))) INTO arlevel;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcate')))) INTO arcate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arzone')))) INTO arzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].aruse')))) INTO aruse;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ardesc')))) INTO ardesc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dimention')))) INTO dimention;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcnt')))) INTO arcnt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].uom')))) INTO uom; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].totsize')))) INTO totsize; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].fltype')))) INTO fltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].walltype')))) INTO walltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].celingtype')))) INTO celingtype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].size')))) INTO size; 
    
if p_type = 'tab' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnumtxt')))) INTO bldgnum;
	 select bl_id into bldg_id from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = p_accountnumber);	
   select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id; -- and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
-- and ba_areacategory_id = arcate_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO l_bldgar_id; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
    if actioncode = 'new' then 
			
        if l_count = 0 then
			INSERT INTO `cm_bldgarea`
			(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
			`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
			`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
			VALUES (bldg_id, reffinfo, artype,  arlevel, arcate, arzone, aruse, ardesc, dimention, arcnt, 
			uom, totsize, fltype,
			walltype, celingtype, p_user, now(), p_user, now(),size);
		
		end if;
    end if;
    
    if actioncode = 'update' then 
		
        
			update`cm_bldgarea` set
			`BA_REF` = reffinfo,
            `BA_AREATYPE_ID` = artype,`BA_AREALEVEL_ID` =arlevel,
            `BA_AREACATEGORY_ID` = arcate,`BA_AREAZONE_ID` =arzone,`BA_AERAUSE_ID` = aruse ,
			`BA_AREADESC` = ardesc,`BA_DIMENTION` = dimention,`BA_UNITCOUNT` = arcnt,`BA_SIZEUNIT_ID` = uom
            ,`BA_TOTSIZE` = totsize,`BA_FLOORTYPE_ID` = fltype,`BA_WALLTYPE_ID` = walltype,
            BA_SIZE = size,
			`BA_CEILINGTYPE_ID` = celingtype,`BA_UPDATEBY` = p_user,`BA_UPDATEDATE` = now() where
            BA_ID = l_bldgar_id;
		
    
    end if;
    
    if actioncode = 'delete' then 
		delete from cm_bldgarea where BA_ID = l_bldgar_id;
    end if;
    
else
            set bldgaccnum = concat(bldgaccnum, fn_check_digit(cast(bldgaccnum  as SIGNED INTEGER)));
    select  bl_bldgtype_id into  bldgtypeid from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = bldgaccnum);	
       
        
    select tdi_parent_key into bldgcategoryid from tbdefitems where tdi_td_name = 'BULDINGTYPE' and tdi_key = bldgtypeid limit 1; 
    
    if artype <> '' then
    select tdi_key into artype_id from tbdefitems where tdi_td_name = 'AREATYPE' and tdi_value = artype limit 1;    
	 end if; 
	 if arlevel <> '' then
    select tdi_key into arlevel_id from tbdefitems where tdi_td_name = 'AREALEVEL' and tdi_value = arlevel  and tdi_parent_key = bldgcategoryid limit 1;  
	 end if; 
	 if arcate <> '' then    
    select tdi_key into arcate_id from tbdefitems where tdi_td_name = 'AREACATEGORY' and tdi_value = arcate limit 1;      
	 end if; 
	 if arzone <> '' then
    select tdi_key into arzone_id from tbdefitems where tdi_td_name = 'AREAZONE' and tdi_value = arzone limit 1;   
	 end if; 
	 if aruse <> '' then   
    select tdi_key into aruse_id from tbdefitems where tdi_td_name = 'AREAUSE' and tdi_value = aruse  and tdi_parent_key = bldgcategoryid limit 1;   
	 end if; 
   
	 if fltype <> '' then       
    select tdi_key into fltype_id from tbdefitems where tdi_td_name = 'FLOORTYPE' and tdi_value = fltype limit 1;     
	 end if; 
	 if walltype <> '' then 
    select tdi_key into walltype_id from tbdefitems where tdi_td_name = 'WALLTYPE' and tdi_value = walltype limit 1;    
	 end if; 
	 if celingtype <> '' then  
    select tdi_key into celingtype_id from tbdefitems where tdi_td_name = 'CEILINGTYPE' and tdi_value = celingtype limit 1;  
	 end if; 
     
     
	 if uom <> '' then  
    select tdi_key into size_id from tbdefitems where tdi_td_name = 'SIZEUNIT' and tdi_value = uom;
	 end if; 




select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
and ba_areacategory_id = arcate_id;
if l_count = 0 then
		INSERT INTO `cm_bldgarea`
		(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
		`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
		`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
		VALUES (bldg_id, reffinfo, artype_id,  arlevel_id, arcate_id, arzone_id, aruse_id, ardesc, dimention, arcnt, 
		size_id, totsize, fltype_id,
		walltype_id, celingtype_id, p_user, now(), p_user, now(),size);
end if;
end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `pr_bldg_area_register_tab` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pr_bldg_area_register_tab`(
	`p_param` JSON
,
	`p_user` VARCHAR(50),
    p_type varchar(50),
    p_accountnumber varchar(15)

) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgnum varchar(15);
DECLARE bldg_id int;
DECLARE reffinfo varchar(50);
DECLARE artype varchar(55);
DECLARE arlevel varchar(55);
DECLARE arcate varchar(50);
DECLARE arzone varchar(50);
DECLARE aruse varchar(50);
DECLARE ardesc varchar(50);
DECLARE dimention varchar(50);
DECLARE arcnt int;
DECLARE size float;
DECLARE uom varchar(50);
DECLARE totsize float;
DECLARE fltype varchar(50);
DECLARE walltype varchar(50);
DECLARE celingtype varchar(50);
DECLARE artype_id varchar(5);
DECLARE arlevel_id varchar(5);
DECLARE arcate_id varchar(5);
DECLARE arzone_id varchar(5);
DECLARE bldgtypeid varchar(55);
DECLARE bldgcategoryid varchar(55);
DECLARE aruse_id varchar(5);
DECLARE fltype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE celingtype_id varchar(5);
DECLARE bldgaccnum varchar(15);
DECLARE size_id varchar(5);
DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgar_id int;
DECLARE operation int;
DECLARE actioncode varchar(10);

WHILE i < JSON_LENGTH(p_param) DO
   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reffinfo')))) INTO reffinfo;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].artype')))) INTO artype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arlevel')))) INTO arlevel;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcate')))) INTO arcate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arzone')))) INTO arzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].aruse')))) INTO aruse;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ardesc')))) INTO ardesc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dimention')))) INTO dimention;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcnt')))) INTO arcnt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].uom')))) INTO uom; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].totsize')))) INTO totsize; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].fltype')))) INTO fltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dwalltype')))) INTO walltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].celingtype')))) INTO celingtype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].size')))) INTO size; 
   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnumtxt')))) INTO bldgnum;
    
	 select bl_id into bldg_id from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = p_accountnumber);	
  -- select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id; -- and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
-- and ba_areacategory_id = arcate_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO l_bldgar_id; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
    if actioncode = 'new' then 
			
       -- if l_count = 0 then
			INSERT INTO `cm_bldgarea`
			(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
			`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
			`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
			VALUES (bldg_id, reffinfo, artype,  arlevel, arcate, arzone, aruse, ardesc, dimention, arcnt, 
			uom, totsize, fltype,
			walltype, celingtype, p_user, now(), p_user, now(),size);
		
		-- end if;
    end if;
    
    if actioncode = 'update' then 
		
        
			update`cm_bldgarea` set
			`BA_REF` = reffinfo,
            `BA_AREATYPE_ID` = artype,`BA_AREALEVEL_ID` =arlevel,
            `BA_AREACATEGORY_ID` = arcate,`BA_AREAZONE_ID` =arzone,`BA_AERAUSE_ID` = aruse ,
			`BA_AREADESC` = ardesc,`BA_DIMENTION` = dimention,`BA_UNITCOUNT` = arcnt,`BA_SIZEUNIT_ID` = uom
            ,`BA_TOTSIZE` = totsize,`BA_FLOORTYPE_ID` = fltype,`BA_WALLTYPE_ID` = walltype,
            BA_SIZE = size,
			`BA_CEILINGTYPE_ID` = celingtype,`BA_UPDATEBY` = p_user,`BA_UPDATEDATE` = now() where
            BA_ID = l_bldgar_id;
		
    
    end if;
    
    if actioncode = 'delete' then 
		delete from cm_bldgarea where BA_ID = l_bldgar_id;
    end if;
   
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `pr_bldg_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pr_bldg_register`(
	`p_param` JSON,
	`p_user` VARCHAR(50),
    `p_type` VARCHAR(50),
    p_accountnumber varchar(15)
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgaccnum varchar(15);
DECLARE bldgnum varchar(300);
DECLARE bldgttype varchar(55);
DECLARE bldgstorey varchar(55);
DECLARE bldgcate varchar(55);
DECLARE bldgcond varchar(50);
DECLARE bldgpos varchar(50);
DECLARE bldgstructure varchar(50);
DECLARE rooftype varchar(50);
DECLARE walltype varchar(50);
DECLARE floortype varchar(50);
DECLARE cccdt VARCHAR(50);
DECLARE occupieddt VARCHAR(50);
DECLARE mainbldg varchar(50);
DECLARE bldgtype_id varchar(10);
DECLARE bldgstorey_id varchar(10);

DECLARE bldgcond_id varchar(5);
DECLARE bldgpos_id varchar(5);
DECLARE bldgstructure_id varchar(5);
DECLARE rooftype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE floortype_id varchar(5);

DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgid int default 0;
DECLARE operation int;
DECLARE actioncode varchar(10);
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgaccnum')))) INTO bldgaccnum;
    if bldgaccnum <> '' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgttype')))) INTO bldgttype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgstorey')))) INTO bldgstorey;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgcond')))) INTO bldgcond;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgpos')))) INTO bldgpos;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgstructure')))) INTO bldgstructure;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].rooftype')))) INTO rooftype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].walltype')))) INTO walltype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].floortype')))) INTO floortype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].cccdt')))) INTO cccdt; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].occupieddt')))) INTO occupieddt; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].mainbldg')))) INTO mainbldg; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgcate')))) INTO bldgcate; 
    
    
	 if bldgttype <> '' then  
    select tdi_key into bldgtype_id from tbdefitems where tdi_td_name = 'BULDINGTYPE' and tdi_value = bldgttype and tdi_parent_name = bldgcate limit 1 ;    
	 end if; 
	 if bldgstorey <> '' then  
    
    select tdi_key into bldgstorey_id from tbdefitems where tdi_td_name = 'BUILDINGSTOREY' and tdi_value = bldgstorey and tdi_parent_name = bldgcate limit 1 ;    
	 end if; 
	 if bldgcond <> '' then  
	     
    select tdi_key into bldgcond_id from tbdefitems where tdi_td_name = 'BLDGCONDN' and tdi_value = bldgcond limit 1 ;      
	 end if; 
	 if bldgpos <> '' then    
    select tdi_key into bldgpos_id from tbdefitems where tdi_td_name = 'BLDGPOSITION' and tdi_value = bldgpos limit 1 ;     
	 end if; 
	 if bldgstructure <> '' then     
    select tdi_key into bldgstructure_id from tbdefitems where tdi_td_name = 'BLDGSTRUCTURE' and tdi_value = bldgstructure limit 1 ;      
	 end if; 
	 if rooftype <> '' then    
    select tdi_key into rooftype_id from tbdefitems where tdi_td_name = 'ROOFTYPE' and tdi_value = rooftype limit 1 ;      
	 end if; 
	 if walltype <> '' then    
    select tdi_key into walltype_id from tbdefitems where tdi_td_name = 'WALLTYPE' and tdi_value = walltype limit 1 ;        
	 end if; 
	 if floortype <> '' then  
    select tdi_key into floortype_id from tbdefitems where tdi_td_name = 'FLOORTYPE' and tdi_value = floortype limit 1 ;    
	 end if; 
    
   

if p_type = 'tab' then

	select ma_id into l_master_id from cm_masterlist where ma_accno = p_accountnumber;
    
   select count(*) into l_count from cm_bldg where bl_ma_id = l_master_id and bl_bldg_no = bldgnum;

   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO l_bldgid; 
    
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode; 
	  if actioncode = 'new' then
      if l_count = 0 then
			INSERT INTO `cm_bldg`
		 (`BL_MA_ID`,    `BL_BLDG_NO`,    `BL_BLDGTYPE_ID`,    `BL_BLDGSTOREY_ID`,    `BL_BLDGCONDN_ID`,
    `BL_BLDGPOSITION_ID`,    `BL_BLDGSTRUCTURE_ID`,    `BL_ROOFTYPE_ID`,    `BL_WALLTYPE_ID`,    `BL_FLOORTYPE_ID`,
    `BL_CCCDATE`,    `BL_OCCUPIEDDATE`,   `BL_ISMAINBLDG_ID`,    `BL_CREATEBY`,    `BL_CREATEDATE`,    `BL_UPDATEBY`,
    `BL_UPDATEDATE`)
		values(l_master_id,bldgnum,bldgttype,bldgstorey, bldgcond ,bldgpos, bldgstructure, rooftype,walltype,floortype ,cccdt,
		occupieddt, mainbldg, p_user, now(), p_user, now());
        end if;
        end if;
	 if actioncode = 'update' then
		update cm_bldg set BL_BLDG_NO=bldgnum,  `BL_BLDGTYPE_ID` = bldgttype,    `BL_BLDGSTOREY_ID` = bldgstorey,    `BL_BLDGCONDN_ID` = bldgcond,
    `BL_BLDGPOSITION_ID` =  bldgpos,    `BL_BLDGSTRUCTURE_ID` = bldgstructure,    `BL_ROOFTYPE_ID` = rooftype,    `BL_WALLTYPE_ID` = walltype,
    `BL_FLOORTYPE_ID` = floortype, BL_CCCDATE = cccdt,
		`BL_OCCUPIEDDATE` = occupieddt, `BL_ISMAINBLDG_ID` = mainbldg, 
`BL_UPDATEBY` = p_user,`BL_UPDATEDATE` = now()
WHERE `BL_ID` = l_bldgid;
		
     end if;
     
     if actioncode = 'delete' then
		delete from cm_bldgarea WHERE `BA_BL_ID` = l_bldgid;   
		delete from cm_bldg WHERE `BL_ID` = l_bldgid;     
     end if;
     
	else
     set bldgaccnum = concat(bldgaccnum, fn_check_digit(cast(bldgaccnum  as SIGNED INTEGER)));
 select ma_id into l_master_id from cm_masterlist where ma_accno = bldgaccnum;
   
   select count(*) into l_count from cm_bldg where bl_ma_id = l_master_id; -- and bl_bldg_no = bldgnum;
if l_count = 0 then
INSERT INTO `cm_bldg` (`BL_MA_ID`,    `BL_BLDG_NO`,    `BL_BLDGTYPE_ID`,    `BL_BLDGSTOREY_ID`,    `BL_BLDGCONDN_ID`,
    `BL_BLDGPOSITION_ID`,    `BL_BLDGSTRUCTURE_ID`,    `BL_ROOFTYPE_ID`,    `BL_WALLTYPE_ID`,    `BL_FLOORTYPE_ID`,
    `BL_CCCDATE`,    `BL_OCCUPIEDDATE`,   `BL_ISMAINBLDG_ID`,    `BL_CREATEBY`,    `BL_CREATEDATE`,    `BL_UPDATEBY`,
    `BL_UPDATEDATE`)
VALUES(l_master_id, bldgnum,bldgtype_id,bldgstorey_id,bldgcond_id,bldgpos_id,bldgstructure_id,rooftype_id,
walltype_id,floortype_id,cccdt, occupieddt,mainbldg, p_user, now(), p_user, now());
end if;
    end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `pr_lot_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pr_lot_register`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    `p_type` VARCHAR(50),
    p_accountnumber varchar(15)
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE acc_no varchar(15);
DECLARE state varchar(30);
DECLARE district varchar(55);
DECLARE state_id varchar(55);
DECLARE district_id varchar(55);
DECLARE city varchar(55);
DECLARE presint varchar(150);
DECLARE presint_id varchar(150);
DECLARE lotype varchar(150);
DECLARE lotnum varchar(150);
DECLARE altlotnum varchar(10);
DECLARE lottitlenum varchar(55);
DECLARE lottitletype varchar(55);
DECLARE alttitlenum varchar(8);
DECLARE landar int DEFAULT 0;
DECLARE landarunit varchar(50);
DECLARE lancond varchar(50);
DECLARE lanposition varchar(50);
DECLARE roadtype varchar(50);
DECLARE roadcategory varchar(50);
DECLARE landuse varchar(50);
DECLARE expresscond varchar(1000);
DECLARE interest varchar(1000);
DECLARE tenuretype varchar(50);
DECLARE tenureperiod int DEFAULT 0;
DECLARE st_tenstartdt varchar(50);
DECLARE st_tenenddt varchar(50);
DECLARE tenstartdt varchar(50);
DECLARE tenenddt varchar(50);
DECLARE landstatus varchar(10);
DECLARE landstatus_id int;
DECLARE l_master_id int;
DECLARE lottyp_id varchar(50);
DECLARE title_type_id varchar(50);
DECLARE unit_id varchar(50);
DECLARE landcond_id varchar(5);
DECLARE landpos_id varchar(5);
DECLARE roadtype_id varchar(5);
DECLARE roadcategory_id varchar(5);
DECLARE tenanttype_id varchar(5);
DECLARE landuse_id varchar(5);
DECLARE l_count int default 0;
DECLARE l_lotid int default 0;
DECLARE operation int default 0;
DECLARE actioncode varchar(10);


WHILE i < JSON_LENGTH(p_param) DO
	
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotaccnum')))) INTO acc_no;
    if acc_no <> ''  then
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotstate')))) INTO state;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotdistrict')))) INTO district;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotcity')))) INTO city;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].presint')))) INTO presint;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotype')))) INTO lotype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotnum')))) INTO lotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].altlotnum')))) INTO altlotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lttt')))) INTO lottitletype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ltnum')))) INTO lottitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].altnum')))) INTO alttitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landar')))) INTO landar;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landaruni')))) INTO landarunit;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landcon')))) INTO lancond;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lanpos')))) INTO lanposition;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roadtype')))) INTO roadtype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roadcate')))) INTO roadcategory;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landuse')))) INTO landuse;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].expcon')))) INTO expresscond;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].interest')))) INTO interest;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tentype')))) INTO tenuretype; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tenduration')))) INTO tenureperiod; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tenstart')))) INTO st_tenstartdt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tenend')))) INTO st_tenenddt; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].status')))) INTO landstatus; 
		
    
    
	 if district <> '' then  
    select tdi_key into district_id from tbdefitems where tdi_td_name = 'DISTRICT' and tdi_value = district;
    
	 end if; 
	 if state <> '' then  
    select tdi_key into state_id from tbdefitems where tdi_td_name = 'STATE' and tdi_value = state;
    
	 end if; 
	 if lotype <> '' then  
    select tdi_key into lottyp_id from tbdefitems where tdi_td_name = 'LOTCODE' and tdi_value = lotype;
	 end if; 
	 if lottitletype <> '' then  
    select tdi_key into title_type_id from tbdefitems where tdi_td_name = 'TITLETYPE' and tdi_value = lottitletype;
	 end if; 
	 if landarunit <> '' then  
    select tdi_key into unit_id from tbdefitems where tdi_td_name = 'SIZEUNIT' and tdi_value = landarunit;
	 end if; 
	 if lancond <> '' then  
    select tdi_key into landcond_id from tbdefitems where tdi_td_name = 'LANDCONDITION' and tdi_value = lancond;
	 end if; 
	 if lanposition <> '' then  
    select tdi_key into landpos_id from tbdefitems where tdi_td_name = 'LANDPOSISION' and tdi_value = lanposition;
	 end if; 
	 if roadtype <> '' then  
    select tdi_key into roadtype_id from tbdefitems where tdi_td_name = 'ROADTYPE' and tdi_value = roadtype;
	 end if; 
	 if roadcategory <> '' then  
    select tdi_key into roadcategory_id from tbdefitems where tdi_td_name = 'ROADCATEGORY' and tdi_value = roadcategory;
	 end if; 
	 if tenuretype <> '' then  
    select tdi_key into tenanttype_id from tbdefitems where tdi_td_name = 'TENURETYPE' and tdi_value = tenuretype;
	 end if; 
	 if landuse <> '' then  
    select tdi_key into landuse_id from tbdefitems where tdi_td_name = 'LANDUSE' and tdi_value = landuse;
	 end if; 
     
	 if landstatus <> '' then  
    select tdi_key into landstatus_id from tbdefitems where tdi_td_name = 'ACTIVEIND' and tdi_value = landstatus;
	 end if; 
     
   
	   if p_type = 'tab' then
       
			 
    select ma_id into l_master_id from cm_masterlist where ma_accno = p_accountnumber;
    
    select count(*) into l_count from cm_lot where lo_ma_id = l_master_id and lo_lotcode_id = lottyp_id  and lo_no = lotnum ;
   
			
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lot_id')))) INTO l_lotid; 
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode; 
            if actioncode = 'new' then
				if l_count = 0 then
					INSERT INTO  `cm_lot`
					(`LO_MA_ID`,`LO_STATE`,`LO_DISTRICT`,`LO_LOTCODE_ID`,`LO_NO`,
					`LO_ALTNO`,`LO_TITLETYPE_ID`,`LO_TITLENO`,`LO_ALTTITLENO`,`LO_SIZE`,`LO_SIZEUNIT_ID`,`LO_LANDCONDITION_ID`,
					`LO_LANDPOSITION_ID`,`LO_ROADTYPE_ID`,`LO_ROADCATEGORY_ID`,`LO_LANDUSE_ID`,`LO_EXCD`,`LO_RTIT`,
					`LO_TENURETYPE_ID`,`LO_TENUREPERIOD`,`LO_STARTDATE`,`LO_EXPIREDDATE`,`LO_ACTIVEIND_ID`,`LO_CREATEDBY`,
					`LO_CREATEDATE`,`LO_UPDATEBY`,`LO_UPDATEDATE`)
					VALUES(l_master_id, state, district, lotype, lotnum, altlotnum, lottitletype, lottitlenum,
					 alttitlenum, landar, landarunit, lancond, lanposition, roadtype, roadcategory, landuse, expresscond,
					 interest, tenuretype, tenureperiod, st_tenstartdt, st_tenenddt, landstatus,p_user,now(),p_user, now());
				end if;
            end if;
            if actioncode = 'update' then
				UPDATE  `cm_lot` SET
					`LO_STATE` = state,`LO_DISTRICT` = district,`LO_LOTCODE_ID` = 
                    lotype,`LO_NO` = lotnum,
					`LO_ALTNO` = altlotnum,`LO_TITLETYPE_ID` = lottitletype,`LO_TITLENO` = lottitlenum,
                    `LO_ALTTITLENO` = alttitlenum,`LO_SIZE` = landar,`LO_SIZEUNIT_ID` = landarunit,`LO_LANDCONDITION_ID` = lancond,
					`LO_LANDPOSITION_ID` = lanposition,`LO_ROADTYPE_ID` = roadtype,`LO_ROADCATEGORY_ID` = roadcategory,
                    `LO_LANDUSE_ID` = landuse,`LO_EXCD` = expresscond,`LO_RTIT` = interest,
					`LO_TENURETYPE_ID` = tenuretype,`LO_TENUREPERIOD` = tenureperiod,`LO_STARTDATE` = st_tenstartdt,
                    `LO_EXPIREDDATE` = st_tenstartdt,`LO_ACTIVEIND_ID` = landstatus,`LO_UPDATEBY` = p_user,`LO_UPDATEDATE` = now()
                    WHERE `LOT_ID` = l_lotid;      
            end if;    
            
            if actioncode = 'delete' then
            
				delete from cm_lot where `LOT_ID` = l_lotid;
            end if;
		else
        
			 
       set acc_no = concat(acc_no, fn_check_digit(cast(acc_no  as SIGNED INTEGER)));
    select ma_id into l_master_id from cm_masterlist where ma_accno = acc_no;
    
    select count(*) into l_count from cm_lot where lo_ma_id = l_master_id; -- and lo_lotcode_id = lottyp_id  and lo_no = lotnum ;
   
			if l_count = 0 then
				INSERT INTO  `cm_lot`
				(`LO_MA_ID`,`LO_STATE`,`LO_DISTRICT`,`LO_LOTCODE_ID`,`LO_NO`,
				`LO_ALTNO`,`LO_TITLETYPE_ID`,`LO_TITLENO`,`LO_ALTTITLENO`,`LO_SIZE`,`LO_SIZEUNIT_ID`,`LO_LANDCONDITION_ID`,
				`LO_LANDPOSITION_ID`,`LO_ROADTYPE_ID`,`LO_ROADCATEGORY_ID`,`LO_LANDUSE_ID`,`LO_EXCD`,`LO_RTIT`,
				`LO_TENURETYPE_ID`,`LO_TENUREPERIOD`,`LO_STARTDATE`,`LO_EXPIREDDATE`,`LO_ACTIVEIND_ID`,`LO_CREATEDBY`,
				`LO_CREATEDATE`,`LO_UPDATEBY`,`LO_UPDATEDATE`)
				VALUES(l_master_id, state_id, district_id, lottyp_id, lotnum, altlotnum, title_type_id, lottitlenum,
		 alttitlenum, landar, unit_id, landcond_id, landpos_id, roadtype_id, roadcategory_id, landuse_id, expresscond,
		 interest, tenanttype_id, tenureperiod, st_tenstartdt, st_tenenddt, landstatus_id,p_user,now(),p_user, now());
			end if;
		end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;

RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `pr_master_add` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pr_master_add`(
	`p_param` json
,
	`p_user` VARCHAR(50),
	`basket_id` INT,
    `p_type` VARCHAR(50)


) RETURNS varchar(15) CHARSET utf8
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE acc_no varchar(15);
DECLARE file_no varchar(30);
DECLARE sub_zone varchar(55);
DECLARE district varchar(55);
DECLARE subzone_id varchar(55);
DECLARE district_id varchar(55);
DECLARE applicationtype varchar(5);
DECLARE address1 varchar(150);
DECLARE address2 varchar(150);
DECLARE address3 varchar(150);
DECLARE address4 varchar(150);
DECLARE postcode varchar(10);
DECLARE city varchar(55);
DECLARE state varchar(55);
DECLARE bldgtype varchar(55);
DECLARE bldgtype_id int DEFAULT '0';
DECLARE state_id varchar(5);
DECLARE l_master_id int;
DECLARE l_length int;
DECLARE l_acc_no varchar(15);

WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')))) INTO acc_no;
    if acc_no <> ''  then
   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].filenumber')))) INTO file_no;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].district')))) INTO district;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].subzone')))) INTO sub_zone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].address1')))) INTO address1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].address2')))) INTO address2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].address3')))) INTO address3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].address4')))) INTO address4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].city')))) INTO city;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].postcode')))) INTO postcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].state')))) INTO state; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgtype')))) INTO bldgtype; 
    
    
    select tdi_key into state_id from tbdefitems where tdi_td_name = 'STATE' and tdi_value = state;
    
    
    select tdi_key into district_id from tbdefitems where tdi_td_name = 'DISTRICT' and tdi_value = district;
    
    
    select tdi_key into subzone_id from tbdefitems where tdi_td_name = 'SUBZONE' and tdi_value = sub_zone;
    
	select tdi_key into bldgtype_id from tbdefitems where tdi_td_name = 'ISHASBUILDING' and tdi_value = bldgtype;
    
	select count(*) into l_length from cm_masterlist where ma_accno = acc_no;
    select pb_applicationtype_id into applicationtype from cm_propbasket where pb_id = basket_id;
    if p_type = 'tab' then 
    if l_length = 0 then
		INSERT INTO `cm_masterlist`
			(`ma_pb_id`,
			`ma_accno`,`ma_fileno`,`ma_subzone_id`,`ma_district_id`,`ma_addr_ln1`,`ma_addr_ln2`,`ma_addr_ln3`,`ma_addr_ln4`,
			`ma_city`,`ma_state_id`,`ma_postcode`,`ma_createby`,`ma_createdate`,`ma_updateby`,`ma_updatedate`,
			`ma_ishasbuilding_id`,`ma_approvalstatus_id`,`ma_applicationtype_id`)
			VALUES(basket_id,acc_no, file_no, sub_zone, district, address1, address2, address3, address4, 
			city, state, postcode, p_user, now(), p_user, now(), bldgtype, '02', applicationtype);
            
            update cm_propbasket set PB_APPROVALSTATUS_ID = '01' where pb_id = basket_id;
            
            else 
            
				UPDATE `cm_masterlist`
			SET `ma_fileno` = file_no ,`ma_subzone_id` = sub_zone,
			`ma_district_id` = district,`ma_addr_ln1` = address1,`ma_addr_ln2` = address2,
			`ma_addr_ln3` = address3,`ma_addr_ln4` = address4,`ma_city` = city,`ma_state_id` = state,
			`ma_postcode` = postcode,
			`ma_updateby` = p_user,`ma_updatedate` = now(),`ma_ishasbuilding_id` = bldgtype
			WHERE `ma_accno` = acc_no;
            end if;
             set l_acc_no = acc_no;
    else
  

    if acc_no is not null and acc_no <> ''  then
		set acc_no = concat(acc_no, fn_check_digit(cast(acc_no  as SIGNED INTEGER)));
		-- set l_acc_no = acc_no;
        
		select count(*) into l_length from cm_masterlist where ma_accno = acc_no;	
		if l_length = 0 then
			INSERT INTO `cm_masterlist`
			(`ma_pb_id`,
			`ma_accno`,`ma_fileno`,`ma_subzone_id`,`ma_district_id`,`ma_addr_ln1`,`ma_addr_ln2`,`ma_addr_ln3`,`ma_addr_ln4`,
			`ma_city`,`ma_state_id`,`ma_postcode`,`ma_createby`,`ma_createdate`,`ma_updateby`,`ma_updatedate`,
			`ma_ishasbuilding_id`,`ma_approvalstatus_id`,`ma_applicationtype_id`)
			VALUES(basket_id,acc_no, file_no, subzone_id, district_id, address1, address2, address3, address4, 
			city, state_id, postcode, p_user, now(), p_user, now(), bldgtype_id,'02', applicationtype);
            
            update cm_propbasket set PB_APPROVALSTATUS_ID = '01' where pb_id = basket_id;
        end if;
    end if;
      end if;
      
      end if;
       SELECT i + 1 INTO i;
END WHILE;

RETURN l_acc_no;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `pr_owner_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pr_owner_register`(
	`p_param` JSON,
	`p_user` VARCHAR(50),
    `p_type` VARCHAR(50),
    p_accountnumber varchar(15)


) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE owneraccnum varchar(15);
DECLARE ownaplntype varchar(30);
DECLARE typeofown varchar(55);
DECLARE ownnum varchar(55);
DECLARE ownname varchar(80);
DECLARE ownaddr1 varchar(150);
DECLARE ownaddr2 varchar(150);
DECLARE ownaddr3 varchar(150);
DECLARE ownaddr4 varchar(150);
DECLARE ownpostcode varchar(10);
DECLARE ownstate varchar(55);
DECLARE citizen varchar(55);
DECLARE state_id varchar(50);
DECLARE telno varchar(15);
DECLARE faxno varchar(15);
DECLARE race varchar(55);
DECLARE demominator int default 1;
DECLARE numerator int default 1;
DECLARE race_id varchar(10);
DECLARE citizen_id varchar(10);
DECLARE owntype_id varchar(10);
DECLARE l_master_id int;
DECLARE l_count int;
DECLARE l_ownerid int default 0;
DECLARE operation int;
DECLARE actioncode varchar(10);

WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].owneraccnum')))) INTO owneraccnum;
    if owneraccnum  <> '' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownaplntype')))) INTO ownaplntype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].typeofown')))) INTO typeofown;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownnum')))) INTO ownnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownaddr1')))) INTO ownaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownaddr2')))) INTO ownaddr2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownaddr3')))) INTO ownaddr3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownaddr4')))) INTO ownaddr4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownpostcode')))) INTO ownpostcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownstate')))) INTO ownstate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].telno')))) INTO telno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].faxno')))) INTO faxno; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].citizen')))) INTO citizen; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].race')))) INTO race; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].demominator')))) INTO demominator; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].numerator')))) INTO numerator;
     
    
    if ownaplntype = 'CMK' then
    set ownaplntype = 'C';
    end if;
    
    if ownaplntype = 'KAD' then
    set ownaplntype = 'K';
    end if;
	 if ownstate <> '' then  
    select tdi_key into state_id from tbdefitems where tdi_td_name = 'STATE' and tdi_value = ownstate;
    
	 end if; 
	 if typeofown <> '' then  
    select tdi_key into owntype_id from tbdefitems where tdi_td_name = 'OWNTYPE' and tdi_value = typeofown;
	 end if; 
	 if citizen <> '' then  
    select tdi_key into citizen_id from tbdefitems where tdi_td_name = 'CITIZEN' and tdi_value = citizen;
	 end if; 
	 if race <> '' then  
    select tdi_key into race_id from tbdefitems where tdi_td_name = 'RACE' and tdi_value = race;
	 end if; 
    
    
    select ma_id into l_master_id from cm_masterlist where ma_accno = owneraccnum;

    
   if demominator = '' then 
	set  @demominator = 0;
   end if; 
   select count(*) into l_count from cm_owner where to_ma_id = l_master_id and to_owntype_id = owntype_id and to_ownno = ownnum;
   
   if p_type = 'tab' then
    select ma_id into l_master_id from cm_masterlist where ma_accno = p_accountnumber;
	 select count(*) into l_count from cm_owner where to_ma_id = l_master_id and to_owntype_id = owntype_id and to_ownno = ownnum;
   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ownerid')))) INTO l_ownerid; 
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
	  if actioncode = 'new' then
      if l_count = 0 then
			INSERT INTO `cm_owner`
		(`TO_MA_ID`,`TO_OWNERAPPLNTYPE_ID`,`TO_OWNTYPE_ID`,`TO_OWNNO`,`TO_OWNNAME`,`TO_ADDR_LN1`,`TO_ADDR_LN2`,`TO_ADDR_LN3`,
		`TO_ADDR_LN4`,`TO_POSTCODE`,`TO_STATE_ID`,`TO_CITIZEN_ID`,`TO_RACE_ID`,`TO_DENOMTR`,
		`TO_CREATEBY`,`TO_CREATEDATE`,`TO_UPDATEBY`,`TO_UPDATEDATE`,TO_TELNO,TO_FAXNO, TO_NUMETR,TO_CITY)
		values(l_master_id,ownaplntype,typeofown,ownnum, ownname ,ownaddr1, ownaddr2, ownaddr3,ownaddr4,ownpostcode ,ownstate,
		citizen, race, demominator, p_user, now(), p_user, now(),telno,faxno, numerator,'Test');
         end if;
        end if;
	 if actioncode = 'update' then
		update cm_owner set  `TO_OWNERAPPLNTYPE_ID` = ownaplntype,`TO_OWNTYPE_ID` = typeofown,
`TO_OWNNO` = ownnum,`TO_OWNNAME` = ownname,`TO_ADDR_LN1` = ownaddr1,`TO_ADDR_LN2` = ownaddr2,
`TO_ADDR_LN3` = ownaddr3,`TO_ADDR_LN4` = ownaddr4,`TO_POSTCODE` = ownpostcode,`TO_STATE_ID` = ownstate,
`TO_CITIZEN_ID` = citizen,`TO_RACE_ID` = race,`TO_DENOMTR` = demominator,
`TO_UPDATEBY` = p_user,`TO_UPDATEDATE` = now(), TO_TELNO = telno,TO_FAXNO = faxno , TO_NUMETR = numerator
WHERE `TO_ID` = l_ownerid;
		
     end if;
     
     if actioncode = 'delete' then
		delete from cm_owner WHERE `TO_ID` = l_ownerid;     
     end if;
     
	else
   set owneraccnum = concat(owneraccnum, fn_check_digit(cast(owneraccnum  as SIGNED INTEGER)));
   
    select ma_id into l_master_id from cm_masterlist where ma_accno = owneraccnum;
    select count(*) into l_count from cm_owner where to_ma_id = l_master_id and to_owntype_id = owntype_id and to_ownno = ownnum;
    if l_count = 0 then
    
		
		INSERT INTO `cm_owner`
		(`TO_MA_ID`,`TO_OWNERAPPLNTYPE_ID`,`TO_OWNTYPE_ID`,`TO_OWNNO`,`TO_OWNNAME`,`TO_ADDR_LN1`,`TO_ADDR_LN2`,`TO_ADDR_LN3`,
		`TO_ADDR_LN4`,`TO_POSTCODE`,`TO_STATE_ID`,`TO_CITIZEN_ID`,`TO_RACE_ID`,`TO_DENOMTR`,
		`TO_CREATEBY`,`TO_CREATEDATE`,`TO_UPDATEBY`,`TO_UPDATEDATE`,TO_TELNO,TO_FAXNO, TO_NUMETR)
		values(l_master_id,ownaplntype,owntype_id,ownnum, ownname ,ownaddr1, ownaddr2, ownaddr3,ownaddr4,ownpostcode ,state_id,
		citizen_id, race_id, demominator, p_user, now(), p_user, now(),telno,faxno, numerator);
       
        end if;
        
         end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `roundoff` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `roundoff`(num double, inputcategory int) RETURNS double
BEGIN
declare  temp int default 1;
declare  temp1 double;
declare  temp2 double;
declare  temp3 double;
declare  diffParam int;

	if num >= 10000 then
        set diffParam = 1000;
	elseif (num < 10000 && num >= 1000) then
        set diffParam = 1000;
    elseif (num < 1000 && num >= 10) then
        set diffParam = 100;
    elseif (num < 10) then
        set diffParam = 1;
    end if;

    
    if inputcategory = 1 then
		
         while(num > diffParam) do
	        set num = FLOOR(num/diffParam);
	        set temp = temp * diffParam;
	    end while;

	    return num*temp;

	elseif inputcategory = 2 then 
		set temp1 = diffParam / 2;		
        set temp2 = num % diffParam;        
        set temp3 = floor(num / diffParam);        
        set temp3 = temp3 + 1;
        
		return temp3 * diffParam;

	elseif inputcategory = 3 then 
		set temp1 = diffParam / 2;
		
        set temp2 = num % diffParam;
        
        set temp3 = floor(num / diffParam);
        
       
		return temp3 * diffParam;
	end if;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `SPLIT_STR` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR`(
  x VARCHAR(255),
  delim VARCHAR(12),
  pos INT
) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '') ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_attachment_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_attachment_trn`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int,
    p_basketid int
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE acc_no varchar(15);
DECLARE filename varchar(30);
DECLARE description varchar(55);
DECLARE filepath varchar(55);
DECLARE attachtype varchar(55);
DECLARE attachtypeid varchar(55);
DECLARE actioncode varchar(55);
DECLARE atfilename text;
DECLARE id int;
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].id')))) INTO id;     
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].filename')))) INTO filename;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].desc')))) INTO description;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].filepath')))) INTO filepath;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].attype')))) INTO attachtype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].undefined')))) INTO atfilename;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;

	 if actioncode = 'new' then
     
       select tdi_key into attachtypeid from tbdefitems where tdi_td_name = 'ATTACHMENTTYPE' and tdi_value = attachtype limit 1 ;      
		
     end if;
     
     if actioncode = 'delete' then
		delete from cm_attachment WHERE `at_id` = id;     
     end if;
     
	
    
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_bldgarea_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_bldgarea_trn`(
	`p_param` JSON
,
	`p_user` VARCHAR(50),
    p_accountnumber varchar(15),
    prop_id int,
    p_basketid int

) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgnum varchar(15);
DECLARE bldg_id int;
DECLARE reffinfo varchar(50);
DECLARE artype varchar(55);
DECLARE arlevel varchar(55);
DECLARE arcate varchar(50);
DECLARE arzone varchar(50);
DECLARE aruse varchar(50);
DECLARE ardesc TEXT;
DECLARE dimention varchar(50);
DECLARE arcnt int;
DECLARE size float;
DECLARE uom varchar(50);
DECLARE totsize float;
DECLARE fltype varchar(50);
DECLARE walltype varchar(50);
DECLARE celingtype varchar(50);
DECLARE artype_id varchar(5);
DECLARE arlevel_id varchar(5);
DECLARE arcate_id varchar(5);
DECLARE arzone_id varchar(5);
DECLARE aruse_id varchar(5);
DECLARE fltype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE celingtype_id varchar(5);
DECLARE bldgaccnum varchar(15);
DECLARE size_id varchar(5);
DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgar_id int;
DECLARE operation int;
DECLARE actioncode varchar(10);

WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgaccnum')))) INTO bldgaccnum;
    
    
    if bldgnum <> '' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reffinfo')))) INTO reffinfo;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].artype')))) INTO artype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arlevel')))) INTO arlevel;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcate')))) INTO arcate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arzone')))) INTO arzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].aruse')))) INTO aruse;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ardesc')))) INTO ardesc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dimention')))) INTO dimention;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcnt')))) INTO arcnt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].uom')))) INTO uom; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].totsize')))) INTO totsize; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].fltype')))) INTO fltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dwalltype')))) INTO walltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].celingtype')))) INTO celingtype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].size')))) INTO size; 
           
    select ab_id into bldg_id from cm_appln_bldg where ab_bldg_no = bldgnum and ab_vd_id in (select vd_id from cm_appln_valdetl where vd_accno = bldgaccnum and vd_va_id = p_basketid);	


	
   select count(*) into l_count from cm_appln_bldgarea where aba_ab_id = bldg_id and `ABA_REF` = reffinfo and
            `ABA_AREATYPE_ID` = artype and `ABA_AREALEVEL_ID` =arlevel and
            `ABA_AREACATEGORY_ID` = arcate and `ABA_AREAZONE_ID` =arzone and `aba_areause_id` = aruse and
			`ABA_AREADESC` = ardesc and `ABA_DIMENTION` = dimention and `ABA_UNITCOUNT` = arcnt and `ABA_SIZEUNIT_ID` = uom
            and `ABA_TOTSIZE` = totsize and `ABA_FLOORTYPE_ID` = fltype and `ABA_WALLTYPE_ID` = walltype and
            ABA_SIZE = size and
			`ABA_CEILINGTYPE_ID` = celingtype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO l_bldgar_id; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
    if actioncode = 'new' then 
			
        if l_count = 0 then
			INSERT INTO `cm_appln_bldgarea`
			(`ABA_AB_ID`,`ABA_REF`,`ABA_AREATYPE_ID`,`ABA_AREALEVEL_ID`,`ABA_AREACATEGORY_ID`,`ABA_AREAZONE_ID`,`aba_areause_id`,
			`ABA_AREADESC`,`ABA_DIMENTION`,`ABA_UNITCOUNT`,`ABA_SIZEUNIT_ID`,`ABA_TOTSIZE`,`ABA_FLOORTYPE_ID`,`ABA_WALLTYPE_ID`,
			`ABA_CEILINGTYPE_ID`,`ABA_CREATEBY`,`ABA_CREATEDATE`,`ABA_UPDATEBY`,`ABA_UPDATEDATE`,ABA_SIZE)
			VALUES (ifnull(bldg_id,bldgnum), reffinfo, artype,  arlevel, arcate, arzone, aruse, ardesc, dimention, arcnt, 
			uom, totsize, fltype,
			walltype, celingtype, p_user, now(), p_user, now(),size);
		
		end if;
    end if;
    
    if actioncode = 'update' then 
		
        
			update `cm_appln_bldgarea` set
			`ABA_REF` = reffinfo,
            `ABA_AREATYPE_ID` = artype,`ABA_AREALEVEL_ID` =arlevel,
            `ABA_AREACATEGORY_ID` = arcate,`ABA_AREAZONE_ID` =arzone,`aba_areause_id` = aruse ,
			`ABA_AREADESC` = ardesc,`ABA_DIMENTION` = dimention,`ABA_UNITCOUNT` = arcnt,`ABA_SIZEUNIT_ID` = uom
            ,`ABA_TOTSIZE` = totsize,`ABA_FLOORTYPE_ID` = fltype,`ABA_WALLTYPE_ID` = walltype,
            ABA_SIZE = size,
			`ABA_CEILINGTYPE_ID` = celingtype,`ABA_UPDATEBY` = p_user,`ABA_UPDATEDATE` = now() where
            ABA_ID = l_bldgar_id;
		
    
    end if;
    
    if actioncode = 'delete' then 
		delete from cm_appln_bldgarea where ABA_ID = l_bldgar_id;
    end if;
    

    end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_bldg_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_bldg_trn`(
	`p_param` JSON,
	`p_user` VARCHAR(50),
    p_accountnumber varchar(15),
    prop_id int,
    p_basketid int
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgaccnum varchar(15);
DECLARE bldgnum varchar(30);
DECLARE bldgttype varchar(55);
DECLARE bldgstorey varchar(55);
DECLARE bldgcond varchar(50);
DECLARE bldgpos varchar(50);
DECLARE bldgstructure varchar(50);
DECLARE rooftype varchar(50);
DECLARE walltype varchar(50);
DECLARE floortype varchar(50);
DECLARE cccdt VARCHAR(50);
DECLARE occupieddt VARCHAR(50);
DECLARE mainbldg varchar(50);
DECLARE bldgtype_id varchar(10);
DECLARE bldgstorey_id varchar(10);

DECLARE bldgcond_id varchar(5);
DECLARE bldgpos_id varchar(5);
DECLARE bldgstructure_id varchar(5);
DECLARE rooftype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE floortype_id varchar(5);

DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgid int default 0;
DECLARE operation int;
DECLARE actioncode varchar(10);
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgaccnum')))) INTO bldgaccnum;
    if bldgaccnum <> '' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgttype')))) INTO bldgttype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgstorey')))) INTO bldgstorey;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgcond')))) INTO bldgcond;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgpos')))) INTO bldgpos;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgstructure')))) INTO bldgstructure;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].rooftype')))) INTO rooftype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].walltype')))) INTO walltype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].floortype')))) INTO floortype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].cccdt')))) INTO cccdt; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].occupieddt')))) INTO occupieddt; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].mainbldg')))) INTO mainbldg; 


	select vd_id into l_master_id from cm_appln_valdetl where vd_accno = p_accountnumber and vd_va_id = p_basketid;
    
   select count(*) into l_count from cm_appln_bldg where AB_VD_ID = l_master_id and AB_BLDG_NO = bldgnum;

   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO l_bldgid; 
    
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode; 
	  if actioncode = 'new' then
      if l_count = 0 then
			INSERT INTO `cm_appln_bldg`
		 (`AB_VD_ID`,    `AB_BLDG_NO`,    `AB_BLDGTYPE_ID`,    `AB_BLDGSTOREY_ID`,    `AB_BLDGCONDN_ID`,
    `AB_BLDGPOSITION_ID`,    `AB_BLDGSTRUCTURE_ID`,    `AB_ROOFTYPE_ID`,    `AB_WALLTYPE_ID`,    `AB_FLOORTYPE_ID`,
    `AB_CCCDATE`,    `AB_OCCUPIEDDATE`,   `AB_ISMAINBLDG_ID`,    `AB_CREATEBY`,    `AB_CREATEDATE`,    `AB_UPDATEBY`,
    `AB_UPDATEDATE`)
		values(l_master_id,bldgnum,bldgttype,bldgstorey, bldgcond ,bldgpos, bldgstructure, rooftype,walltype,floortype ,
        DATE_FORMAT(STR_TO_DATE(cccdt, '%d/%m/%Y'), '%Y-%m-%d'),
		DATE_FORMAT(STR_TO_DATE(occupieddt, '%d/%m/%Y'), '%Y-%m-%d'), mainbldg, p_user, now(), p_user, now());
        end if;
        end if;
	 if actioncode = 'update' then
		update cm_appln_bldg set   `AB_BLDGTYPE_ID` = bldgttype,    `AB_BLDGSTOREY_ID` = bldgstorey,    `AB_BLDGCONDN_ID` = bldgcond,
    `AB_BLDGPOSITION_ID` =  bldgpos,    `AB_BLDGSTRUCTURE_ID` = bldgstructure,    `AB_ROOFTYPE_ID` = rooftype,    `AB_WALLTYPE_ID` = walltype,
    `AB_FLOORTYPE_ID` = floortype, AB_CCCDATE = DATE_FORMAT(STR_TO_DATE(cccdt, '%d/%m/%Y'), '%Y-%m-%d'),
		`AB_OCCUPIEDDATE` = DATE_FORMAT(STR_TO_DATE(occupieddt, '%d/%m/%Y'), '%Y-%m-%d'), `AB_ISMAINBLDG_ID` = mainbldg, 
`AB_UPDATEBY` = p_user,`AB_UPDATEDATE` = now()
WHERE `AB_ID` = l_bldgid;
		
     end if;
     
     if actioncode = 'delete' then
		delete from cm_appln_bldg WHERE `AB_ID` = l_bldgid;   
        delete from cm_appln_bldgarea where aba_ab_id = l_bldgid;
     end if;
     
	
    
    end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_lot_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_lot_trn`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    p_accountnumber varchar(15),
    prop_id int,
    p_basketid int
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE acc_no varchar(15);
DECLARE state varchar(30);
DECLARE district varchar(55);
DECLARE state_id varchar(55);
DECLARE district_id varchar(55);
DECLARE city varchar(55);
DECLARE presint varchar(150);
DECLARE presint_id varchar(150);
DECLARE lotype varchar(150);
DECLARE lotnum varchar(150);
DECLARE altlotnum varchar(10);
DECLARE lottitlenum varchar(55);
DECLARE lottitletype varchar(55);
DECLARE alttitlenum varchar(8);
DECLARE landar int DEFAULT 0;
DECLARE landarunit varchar(50);
DECLARE lancond varchar(50);
DECLARE lanposition varchar(50);
DECLARE roadtype varchar(50);
DECLARE roadcategory varchar(50);
DECLARE landuse varchar(50);
DECLARE expresscond varchar(1000);
DECLARE interest varchar(1000);
DECLARE tenuretype varchar(50);
DECLARE tenureperiod int DEFAULT 0;
DECLARE st_tenstartdt varchar(50);
DECLARE st_tenenddt varchar(50);
DECLARE tenstartdt varchar(50);
DECLARE tenenddt varchar(50);
DECLARE landstatus varchar(10);
DECLARE landstatus_id int;
DECLARE l_master_id int;
DECLARE lottyp_id varchar(50);
DECLARE title_type_id varchar(50);
DECLARE unit_id varchar(50);
DECLARE landcond_id varchar(5);
DECLARE landpos_id varchar(5);
DECLARE roadtype_id varchar(5);
DECLARE roadcategory_id varchar(5);
DECLARE tenanttype_id varchar(5);
DECLARE landuse_id varchar(5);
DECLARE l_count int default 0;
DECLARE l_lotid int default 0;
DECLARE operation int default 0;
DECLARE actioncode varchar(10);


WHILE i < JSON_LENGTH(p_param) DO
	
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotaccnum')))) INTO acc_no;
    if acc_no <> ''  then
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotstate')))) INTO state;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotdistrict')))) INTO district;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotcity')))) INTO city;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].presint')))) INTO presint;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotype')))) INTO lotype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotnum')))) INTO lotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].altlotnum')))) INTO altlotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lttt')))) INTO lottitletype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ltnum')))) INTO lottitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].altnum')))) INTO alttitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landar')))) INTO landar;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landaruni')))) INTO landarunit;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landcon')))) INTO lancond;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lanpos')))) INTO lanposition;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roadtype')))) INTO roadtype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roadcate')))) INTO roadcategory;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].landuse')))) INTO landuse;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].expcon')))) INTO expresscond;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].interest')))) INTO interest;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tentype')))) INTO tenuretype; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tenduration')))) INTO tenureperiod; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tenstart')))) INTO st_tenstartdt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].tenend')))) INTO st_tenenddt; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].status')))) INTO landstatus; 
		
      
    
    
	 if district <> '' then  
    select tdi_key into district_id from tbdefitems where tdi_td_name = 'DISTRICT' and tdi_value = district;
    
	 end if; 
	 if state <> '' then  
    select tdi_key into state_id from tbdefitems where tdi_td_name = 'STATE' and tdi_value = state;
    
	 end if; 
	 if lotype <> '' then  
    select tdi_key into lottyp_id from tbdefitems where tdi_td_name = 'LOTCODE' and tdi_value = lotype;
	 end if; 
	 if lottitletype <> '' then  
    select tdi_key into title_type_id from tbdefitems where tdi_td_name = 'TITLETYPE' and tdi_value = lottitletype;
	 end if; 
	 if landarunit <> '' then  
    select tdi_key into unit_id from tbdefitems where tdi_td_name = 'SIZEUNIT' and tdi_value = landarunit;
	 end if; 
	 if lancond <> '' then  
    select tdi_key into landcond_id from tbdefitems where tdi_td_name = 'LANDCONDITION' and tdi_value = lancond;
	 end if; 
	 if lanposition <> '' then  
    select tdi_key into landpos_id from tbdefitems where tdi_td_name = 'LANDPOSISION' and tdi_value = lanposition;
	 end if; 
	 if roadtype <> '' then  
    select tdi_key into roadtype_id from tbdefitems where tdi_td_name = 'ROADTYPE' and tdi_value = roadtype;
	 end if; 
	 if roadcategory <> '' then  
    select tdi_key into roadcategory_id from tbdefitems where tdi_td_name = 'ROADCATEGORY' and tdi_value = roadcategory;
	 end if; 
	 if tenuretype <> '' then  
    select tdi_key into tenanttype_id from tbdefitems where tdi_td_name = 'TENURETYPE' and tdi_value = tenuretype;
	 end if; 
	 if landuse <> '' then  
    select tdi_key into landuse_id from tbdefitems where tdi_td_name = 'LANDUSE' and tdi_value = landuse;
	 end if; 
     
	 if landstatus <> '' then  
    select tdi_key into landstatus_id from tbdefitems where tdi_td_name = 'ACTIVEIND' and tdi_value = landstatus;
	 end if; 
     
   
	   
       
			 
    select vd_id into l_master_id from cm_appln_valdetl where vd_accno = p_accountnumber and vd_va_id = p_basketid;
    
    select count(*) into l_count from cm_appln_lot where al_vd_id = l_master_id and AL_LOTCODE_ID = lottyp_id  and AL_NO = lotnum ;
   
			
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lot_id')))) INTO l_lotid; 
			SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode; 
            if actioncode = 'new' then
				if l_count = 0 then
					INSERT INTO  `cm_appln_lot`
					(`al_vd_id`,`AL_STATE`,`AL_DISTRICT`,`AL_LOTCODE_ID`,`AL_NO`,
					`AL_ALTNO`,`AL_TITLETYPE_ID`,`AL_TITLENO`,`AL_ALTTITLENO`,`AL_SIZE`,`AL_SIZEUNIT_ID`,`AL_LANDCONDITION_ID`,
					`al_landposision_id`,`AL_ROADTYPE_ID`,`AL_ROADCATEGORY_ID`,`AL_LANDUSE_ID`,`AL_EXCD`,`AL_RTIT`,
					`AL_TENURETYPE_ID`,`AL_TENUREPERIOD`,`AL_STARTDATE`,`AL_EXPIREDDATE`,`AL_ACTIVEIND_ID`,`al_createby`,
					`AL_CREATEDATE`,`AL_UPDATEBY`,`AL_UPDATEDATE`)
					VALUES(l_master_id, state, district, lotype, lotnum, altlotnum, lottitletype, lottitlenum,
					 alttitlenum, landar, landarunit, lancond, lanposition, roadtype, roadcategory, landuse, expresscond,
					 interest, tenuretype, tenureperiod,DATE_FORMAT(STR_TO_DATE(st_tenstartdt, '%d/%m/%Y'), '%Y-%m-%d') , DATE_FORMAT(STR_TO_DATE(st_tenenddt, '%d/%m/%Y'), '%Y-%m-%d'), landstatus,p_user,now(),p_user, now());
				end if;
            end if;
            if actioncode = 'update' then
				UPDATE  `cm_appln_lot` SET
					`AL_STATE` = state,`AL_DISTRICT` = district, `
                    AL_LOTCODE_ID` = 
                    lotype,`AL_NO` = lotnum,
					`AL_ALTNO` = altlotnum,`AL_TITLETYPE_ID` = lottitletype,`AL_TITLENO` = lottitlenum,
                    `AL_ALTTITLENO` = alttitlenum,`AL_SIZE` = landar,`AL_SIZEUNIT_ID` = landarunit,`AL_LANDCONDITION_ID` = lancond,
					`al_landposision_id` = lanposition,`AL_ROADTYPE_ID` = roadtype,`AL_ROADCATEGORY_ID` = roadcategory,
                    `AL_LANDUSE_ID` = landuse,`AL_EXCD` = expresscond,`AL_RTIT` = interest,
					`AL_TENURETYPE_ID` = tenuretype,`AL_TENUREPERIOD` = tenureperiod,`AL_STARTDATE` = DATE_FORMAT(STR_TO_DATE(st_tenstartdt, '%d/%m/%Y'), '%Y-%m-%d'),
                    `AL_EXPIREDDATE` = DATE_FORMAT(STR_TO_DATE(st_tenenddt, '%d/%m/%Y'), '%Y-%m-%d'),`AL_ACTIVEIND_ID` = landstatus,`AL_UPDATEBY` = p_user,`AL_UPDATEDATE` = now()
                    WHERE `AL_ID` = l_lotid;      
            end if;    
            
            if actioncode = 'delete' then
            
				delete from cm_appln_lot where `AL_ID` = l_lotid;
            end if;
		
    end if;
    SELECT i + 1 INTO i;
END WHILE;

RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_master_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_master_trn`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int,
    p_basketid int


) RETURNS varchar(15) CHARSET utf8
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE acc_no varchar(15);
DECLARE file_no varchar(30);
DECLARE sub_zone varchar(55);
DECLARE district varchar(55);
DECLARE subzone_id varchar(55);
DECLARE district_id varchar(55);
DECLARE address1 varchar(150);
DECLARE address2 varchar(150);
DECLARE address3 varchar(150);
DECLARE address4 varchar(150);
DECLARE postcode varchar(10);
DECLARE city varchar(55);
DECLARE state varchar(55);
DECLARE bldgtype varchar(55);
DECLARE bldgtype_id int DEFAULT '0';
DECLARE state_id varchar(5);
DECLARE l_master_id int;
DECLARE l_length int;
DECLARE l_count int; 
DECLARE l_totcount int; 
DECLARE l_acc_no varchar(15);


    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.accnumber')))) INTO acc_no;
    if acc_no <> ''  then
    set l_acc_no = acc_no;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.filenumber')))) INTO file_no;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.district')))) INTO district;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.subzone')))) INTO sub_zone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.address1')))) INTO address1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.address2')))) INTO address2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.address3')))) INTO address3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.address4')))) INTO address4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.city')))) INTO city;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.postcode')))) INTO postcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.state')))) INTO state; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.bldgtype')))) INTO bldgtype; 
    
   
    
    select tdi_key into state_id from tbdefitems where tdi_td_name = 'STATE' and tdi_value = state;
    
    
    select tdi_key into district_id from tbdefitems where tdi_td_name = 'DISTRICT' and tdi_value = district;
    
    
    select tdi_key into subzone_id from tbdefitems where tdi_td_name = 'SUBZONE' and tdi_value = sub_zone;
    
	select tdi_key into bldgtype_id from tbdefitems where tdi_td_name = 'ISHASBUILDING' and tdi_value = bldgtype;
	
		UPDATE `cm_appln_valdetl`
		SET `vd_updateby` = p_user,`vd_updatedate` = now(), vd_approvalstatus_id = '05'
		WHERE `vd_accno` = acc_no and vd_va_id = p_basketid;
        
      
       
		UPDATE `cm_masterlist`
		SET `ma_fileno` = file_no ,`ma_subzone_id` = sub_zone,
		`ma_district_id` = district,`ma_addr_ln1` = address1,`ma_addr_ln2` = address2,
		`ma_addr_ln3` = address3,`ma_addr_ln4` = address4,`ma_city` = city,`ma_state_id` = state,
		`ma_postcode` = postcode, 
		`ma_updateby` = p_user,`ma_updatedate` = now()
		WHERE `ma_accno` = acc_no;
      
	end if;
       

RETURN l_acc_no;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_owner_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_owner_register`(
	`p_param` JSON,
	`p_user` VARCHAR(50),
    `p_type` VARCHAR(50),
    p_accountnumber varchar(15)


) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE owneraccnum varchar(15);
DECLARE ownaplntype varchar(30);
DECLARE typeofown varchar(55);
DECLARE ownnum varchar(55);
DECLARE ownname varchar(80);
DECLARE ownaddr1 varchar(150);
DECLARE ownaddr2 varchar(150);
DECLARE ownaddr3 varchar(150);
DECLARE ownaddr4 varchar(150);
DECLARE ownpostcode varchar(10);
DECLARE ownstate varchar(55);

DECLARE addname varchar(80);
DECLARE addaddr1 varchar(150);
DECLARE addaddr2 varchar(150);
DECLARE addaddr3 varchar(150);
DECLARE addaddr4 varchar(150);
DECLARE addpostcode varchar(10);
DECLARE addstate varchar(10);
DECLARE recievedate varchar(55);
DECLARE requestdate varchar(55);
DECLARE transactionprice float;
DECLARE transactiondate varchar(55);
DECLARE refno varchar(55);
DECLARE apprefno varchar(55);
DECLARE rejectreason1 varchar(200);
DECLARE rejectreason2 varchar(200);
DECLARE rejectreason3 varchar(200);
DECLARE rejectreason4 varchar(200);
DECLARE rejectreason5 varchar(200);
DECLARE rejectreason6 varchar(200);


DECLARE citizen varchar(55);
DECLARE state_id varchar(50);
DECLARE telno varchar(15);
DECLARE faxno varchar(15);
DECLARE race varchar(55);
DECLARE demominator int default 0;
DECLARE race_id varchar(10);
DECLARE citizen_id varchar(10);
DECLARE owntype_id varchar(10);
DECLARE l_master_id int;
DECLARE l_count int;
DECLARE l_ownerid int default 0;
DECLARE operation int;
DECLARE actioncode varchar(10);

    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.accnumber')))) INTO owneraccnum;
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaplntype')))) INTO ownaplntype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntypeofown')))) INTO typeofown;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownnum')))) INTO ownnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr1')))) INTO ownaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr2')))) INTO ownaddr2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr3')))) INTO ownaddr3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr4')))) INTO ownaddr4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownpostcode')))) INTO ownpostcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownstate')))) INTO ownstate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntelno')))) INTO telno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nfaxno')))) INTO faxno; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ncitizen')))) INTO citizen; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nrace')))) INTO race; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ndemominator')))) INTO demominator; 
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addname')))) INTO addname; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr1')))) INTO addaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr2')))) INTO addaddr2; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr3')))) INTO addaddr3; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr4')))) INTO addaddr4; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addpostcode')))) INTO addpostcode; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addstate')))) INTO addstate; 
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reqdate')))) INTO requestdate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addacceptdt')))) INTO recievedate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrndate')))) INTO transactiondate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrnvalue')))) INTO transactionprice; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addref')))) INTO refno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addapplicatref')))) INTO apprefno;
    
    
    
	
   
    if ownname <> '' then 
    
		 select ma_id into l_master_id from cm_masterlist where ma_accno = owneraccnum;

		   if demominator = '' then 
			set  @demominator = 0;
		   end if; 
		   select count(*) into l_count from cm_owner where to_ma_id = l_master_id and to_owntype_id = owntype_id and to_ownno = ownnum;
		   
				update cm_owner set  `TO_OWNERAPPLNTYPE_ID` = ownaplntype,`TO_OWNTYPE_ID` = typeofown,
		`TO_OWNNO` = ownnum,`TO_OWNNAME` = ownname,`TO_ADDR_LN1` = ownaddr1,`TO_ADDR_LN2` = ownaddr2,
		`TO_ADDR_LN3` = ownaddr3,`TO_ADDR_LN4` = ownaddr4,`TO_POSTCODE` = ownpostcode,`TO_STATE_ID` = ownstate,
		`TO_CITIZEN_ID` = citizen,`TO_RACE_ID` = race,`TO_DENOMTR` = demominator,
		`TO_UPDATEBY` = p_user,`TO_UPDATEDATE` = now(), TO_TELNO = telno,TO_FAXNO = faxno
		WHERE `TO_MA_ID` = l_master_id;
        
        insert into cm_ownertrans_appln(`ota_transferapplntype_id`,`ota_transferapplntypestatus_id`,
		`ota_owntype_id`,`ota_ownno`,`ota_ownname`,`ota_addr_ln1`,`ota_addr_ln2`,`ota_addr_ln3`,
		`ota_addr_ln4`,`ota_postcode`,`ota_state_id`,`ota_citizen_id`,`ota_race_id`,`ota_phoneno`,
		`ota_denomtr`,`ota_agentname`,`ota_agentaddr_ln1`,`ota_agentaddr_ln2`,`ota_agentaddr_ln3`,
		`ota_agentaddr_ln4`,`ota_agentpostcode`,`ota_agentstate_id`,
		`ota_applydate`,`ota_recievedate`,`ota_transactionprice`,`ota_transactiondate`,`ota_agentrefno`,`ota_rejectreason1`,
		`ota_rejectreason2`,`ota_transtocenterstatus_id`,
		`ota_createby`,`ota_createdate`,
		`ota_updateby`,`ota_updatedate`)
		VALUES (ownaplntype, 2, typeofown, ownnum, ownname, ownaddr1, ownaddr2, ownaddr3, ownaddr4, ownpostcode, ownstate,
		citizen, race, telno, demominator,addname, addaddr1, addaddr2 , addaddr3, addaddr4, addpostcode, addstate,
		 DATE_FORMAT(STR_TO_DATE(requestdate, '%d/%m/%Y'), '%Y-%m-%d'), DATE_FORMAT(STR_TO_DATE(recievedate, '%d/%m/%Y'), '%Y-%m-%d'),
		 transactionprice, DATE_FORMAT(STR_TO_DATE(transactiondate, '%d/%m/%Y'), '%Y-%m-%d'), refno, '', '', '0', p_user, now(), p_user, now() );
				
			
    end if;     
   
RETURN 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_parameter_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_parameter_trn`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int,
    p_basketid int


) RETURNS varchar(15) CHARSET utf8
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE acc_no varchar(15);
DECLARE bldgstatus varchar(30);
DECLARE bldgcategory varchar(55);
DECLARE bldgtype varchar(55);
DECLARE bldglevel varchar(55);
DECLARE l_master_id int;
DECLARE l_count int;
DECLARE l_acc_no varchar(15);


    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.accnumber')))) INTO acc_no;
   
  
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.parambldgstatus')))) INTO bldgstatus;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.parambldgcategory')))) INTO bldgcategory;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.parambldgtype')))) INTO bldgtype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.paramarlevel')))) INTO bldglevel;    
   
select vd_id into l_master_id from cm_appln_valdetl WHERE `vd_accno` = acc_no and vd_va_id = p_basketid;

select count(*) into l_count from cm_appln_parameter WHERE `ap_vd_id` = l_master_id;
	if l_count = 0 then
			INSERT INTO `cm_appln_parameter`(`ap_vd_id`,`ap_bldgstatus_id`,`ap_propertycategory_id`,
            `ap_propertytype_id`,`ap_propertylevel_id`,`ap_createby`,`ap_createdate`,`ap_updateby`,`ap_updatedate`)
            value(l_master_id, bldgstatus, bldgcategory, bldgtype, 
            bldglevel,p_user, now(),p_user,now());
             UPDATE `cm_appln_valdetl`
		SET vd_bldgtype_id = bldgtype
		WHERE `vd_id` = l_master_id;
	else
		UPDATE `cm_appln_parameter`
		SET `ap_bldgstatus_id` = bldgstatus,`ap_propertycategory_id` = bldgcategory,`ap_propertytype_id` = bldgtype,
		ap_propertylevel_id = bldglevel,ap_updateby = p_user, ap_updatedate = now()
		WHERE `ap_vd_id` = l_master_id;
            
           UPDATE `cm_appln_valdetl`
		SET vd_bldgtype_id = bldgtype,vd_ishasbuilding = bldgstatus,vd_bldgstorey_id = bldglevel
		WHERE `vd_id` = l_master_id;
    end if;
RETURN NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_ratepayer_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_ratepayer_trn`(
	`p_param` JSON,
	`p_user` VARCHAR(50),
    p_accountnumber varchar(15),
    prop_id int,
    p_basketid int
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE ratepayerid INT;
DECLARE detailid INT;
DECLARE actioncode varchar(10);
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].rp_id')))) INTO ratepayerid;
   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].vd_id')))) INTO detailid;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode; 
	  if actioncode = 'new' then
      
			INSERT INTO `cm_appln_ratepayer`
		 (`arp_vd_id`,    `arp_rp_id`,    `arp_createby`,    `arp_createdate`,    `arp_updateby`,
    `arp_updatedate`)
		values(prop_id,ratepayerid,p_user, now(), p_user, now());
        end if;
        
		if actioncode = 'delete' then
      
			DELETE FROM `cm_appln_ratepayer` WHERE arp_id = ratepayerid;
        end if;
     
   
	
   
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `val_tenant_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `val_tenant_trn`(
	`p_param` JSON,
	`p_user` VARCHAR(50),
    p_accountnumber varchar(15),
    prop_id int,
    p_basketid int
) RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE tenantid INT;
DECLARE detailid INT;
DECLARE actioncode varchar(10);
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].te_id')))) INTO tenantid;
   
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].vd_id')))) INTO detailid;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode; 
	  if actioncode = 'new' then
      
			INSERT INTO `cm_appln_tenant`
		 (`at_vd_id`,    `at_te_id`,    `at_createby`,    `at_createdate`,    `at_updateby`,
    `at_updatedate`)
		values(prop_id,tenantid,p_user, now(), p_user, now());
        end if;
   if actioncode = 'delete' then
      
			DELETE FROM `cm_appln_tenant` WHERE at_id = tenantid;
        end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `create_proc` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_proc`(
	`p_param` JSON
,
	`p_user` VARCHAR(50),
    p_type varchar(50),
    p_accountnumber varchar(15)

)
BEGIN

DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgnum varchar(15);
DECLARE bldg_id int;
DECLARE reffinfo varchar(50);
DECLARE artype varchar(55);
DECLARE arlevel varchar(55);
DECLARE arcate varchar(50);
DECLARE arzone varchar(50);
DECLARE aruse varchar(50);
DECLARE ardesc varchar(50);
DECLARE dimention varchar(50);
DECLARE arcnt int;
DECLARE size float;
DECLARE uom varchar(50);
DECLARE totsize float;
DECLARE fltype varchar(50);
DECLARE walltype varchar(50);
DECLARE celingtype varchar(50);
DECLARE artype_id varchar(5);
DECLARE arlevel_id varchar(5);
DECLARE arcate_id varchar(5);
DECLARE arzone_id varchar(5);
DECLARE bldgtypeid varchar(55);
DECLARE bldgcategoryid varchar(55);
DECLARE aruse_id varchar(5);
DECLARE fltype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE celingtype_id varchar(5);
DECLARE bldgaccnum varchar(15);
DECLARE size_id varchar(5);
DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgar_id int;
DECLARE operation int;
DECLARE actioncode varchar(10);

WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgaccnum')))) INTO bldgaccnum;
    
     
    if bldgnum <> '' then
    select i;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reffinfo')))) INTO reffinfo;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].artype')))) INTO artype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arlevel')))) INTO arlevel;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcate')))) INTO arcate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arzone')))) INTO arzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].aruse')))) INTO aruse;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ardesc')))) INTO ardesc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dimention')))) INTO dimention;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcnt')))) INTO arcnt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].uom')))) INTO uom; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].totsize')))) INTO totsize; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].fltype')))) INTO fltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].walltype')))) INTO walltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].celingtype')))) INTO celingtype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].size')))) INTO size; 
    
           
    select bl_id, bl_bldgtype_id into bldg_id, bldgtypeid from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = bldgaccnum);	
       
        
    select tdi_parent_key into bldgcategoryid from tbdefitems where tdi_td_name = 'BULDINGTYPE' and tdi_key = bldgtypeid limit 1; 
    
    if artype <> '' then
    select tdi_key into artype_id from tbdefitems where tdi_td_name = 'AREATYPE' and tdi_value = artype limit 1;    
	 end if; 
	 if arlevel <> '' then
    select tdi_key into arlevel_id from tbdefitems where tdi_td_name = 'AREALEVEL' and tdi_value = arlevel  and tdi_parent_key = bldgcategoryid limit 1;  
	 end if; 
	 if arcate <> '' then    
    select tdi_key into arcate_id from tbdefitems where tdi_td_name = 'AREACATEGORY' and tdi_value = arcate limit 1;      
	 end if; 
	 if arzone <> '' then
    select tdi_key into arzone_id from tbdefitems where tdi_td_name = 'AREAZONE' and tdi_value = arzone limit 1;   
	 end if; 
	 if aruse <> '' then   
    select tdi_key into aruse_id from tbdefitems where tdi_td_name = 'AREAUSE' and tdi_value = aruse  and tdi_parent_key = bldgcategoryid limit 1;   
	 end if; 
   
	 if fltype <> '' then       
    select tdi_key into fltype_id from tbdefitems where tdi_td_name = 'FLOORTYPE' and tdi_value = fltype limit 1;     
	 end if; 
	 if walltype <> '' then 
    select tdi_key into walltype_id from tbdefitems where tdi_td_name = 'WALLTYPE' and tdi_value = walltype limit 1;    
	 end if; 
	 if celingtype <> '' then  
    select tdi_key into celingtype_id from tbdefitems where tdi_td_name = 'CEILINGTYPE' and tdi_value = celingtype limit 1;  
	 end if; 
     
     
	 if uom <> '' then  
    select tdi_key into size_id from tbdefitems where tdi_td_name = 'SIZEUNIT' and tdi_value = uom;
	 end if; 


if p_type = 'tab' then
	 select bl_id into bldg_id from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = p_accountnumber);	
   select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id;-- and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
-- and ba_areacategory_id = arcate_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO l_bldgar_id; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
    if actioncode = 'new' then 
			
       -- if l_count = 0 then
			INSERT INTO `cm_bldgarea`
			(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
			`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
			`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
			VALUES (ifnull(bldg_id,bldgnum), reffinfo, artype,  arlevel, arcate, arzone, aruse, ardesc, dimention, arcnt, 
			uom, totsize, fltype,
			walltype, celingtype, p_user, now(), p_user, now(),size);
		
		-- end if;
    end if;
    
    if actioncode = 'update' then 
		
        
			update`cm_bldgarea` set
			`BA_REF` = reffinfo,
            `BA_AREATYPE_ID` = artype,`BA_AREALEVEL_ID` =arlevel,
            `BA_AREACATEGORY_ID` = arcate,`BA_AREAZONE_ID` =arzone,`BA_AERAUSE_ID` = aruse ,
			`BA_AREADESC` = ardesc,`BA_DIMENTION` = dimention,`BA_UNITCOUNT` = arcnt,`BA_SIZEUNIT_ID` = uom
            ,`BA_TOTSIZE` = totsize,`BA_FLOORTYPE_ID` = fltype,`BA_WALLTYPE_ID` = walltype,
            BA_SIZE = size,
			`BA_CEILINGTYPE_ID` = celingtype,`BA_UPDATEBY` = p_user,`BA_UPDATEDATE` = now() where
            BA_ID = l_bldgar_id;
		
    
    end if;
    
    if actioncode = 'delete' then 
		delete from cm_bldgarea where BA_ID = l_bldgar_id;
    end if;
    
else
 set bldgaccnum = concat(bldgaccnum, fn_check_digit(cast(bldgaccnum  as SIGNED INTEGER)));
select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id;-- and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
-- and ba_areacategory_id = arcate_id;
if l_count = 0 then
		INSERT INTO `cm_bldgarea`
		(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
		`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
		`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
		VALUES (bldg_id, reffinfo, artype_id,  arlevel_id, arcate_id, arzone_id, aruse_id, ardesc, dimention, arcnt, 
		size_id, totsize, fltype_id,
		walltype_id, celingtype_id, p_user, now(), p_user, now(),size);
end if;
end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `json_procedure` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `json_procedure`(toneid int, tonetaxid int, basketid int)
BEGIN
select ma_subzone_id,  ab_bldgtype_id, ab_bldgstorey_id,  
            aba_areatype_id,aba_arealevel_id,aba_areacategory_id ,aba_areause_id
            from cm_appln_bldg inner join cm_appln_valdetl on  ab_vd_id = vd_id inner join cm_masterlist on  ma_id = vd_ma_id inner join cm_appln_bldgarea
                  on aba_ab_id = ab_id where ((SELECT tbldg_value
            FROM cm_tone_building
            WHERE (tbldg_tone_id   = toneid)
            AND (tbldg_subzon_id    = ma_subzone_id)
            AND (tbldg_proptype_id        = ab_bldgtype_id)
            AND (tbldg_propstorey_id = ab_bldgstorey_id)
            AND (tbldg_areatype_id     = aba_areatype_id)
            AND (tbldg_arealevel_id    = aba_arealevel_id)
            AND (tbldg_areacategory_id     = aba_areacategory_id)
            AND (tbldg_areause_id    = aba_areause_id)) IS NULL) and vd_va_id = basketid group by ma_subzone_id,  ab_bldgtype_id, ab_bldgstorey_id,  
            aba_areatype_id,aba_arealevel_id,aba_areacategory_id ,aba_areause_id;
            
            select distinct ab_bldgcondn_id
            from cm_appln_valdetl, cm_masterlist, cm_appln_bldg
            where ab_vd_id = vd_id and  ma_id = vd_ma_id and vd_va_id = basketid
            and (SELECT tdepre_value
            FROM cm_tone_bldg_depreciation
            WHERE (tdepre_tone_id   = toneid)
            AND (tdepre_bldgcondn_id    = ab_bldgcondn_id)) IS NULL;
            
            select  ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id 
            from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id
            where ((SELECT tland_value
            FROM cm_tone_land
            WHERE (tland_tone_id   = toneid)
            AND (tland_ishasbuilding_id    = ap_bldgstatus_id)
            AND (tland_subzon_id        = ma_subzone_id)
            AND (tland_proptype_id = ap_propertytype_id)
            AND (tland_propstorey_id = ap_propertylevel_id)) IS NULL ) and vd_va_id = basketid
            group by ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id;
            
            select distinct ma_subzone_id,  ap_propertytype_id, ap_propertylevel_id from cm_appln_valdetl, cm_appln_lot,cm_appln_parameter, cm_masterlist
                where al_vd_id = vd_id and ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_va_id = basketid
                and (SELECT tstand_standartarea
                FROM cm_tone_land_standart
                WHERE (tstand_tone_id   = toneid)
                AND (tstand_subzon_id    = ma_subzone_id)
                AND (tstand_proptype_id        = ap_propertytype_id)
                AND (tstand_propstorey_id = ap_propertylevel_id)) IS NULL;
                
                select  tdi_parent_key, ap_bldgstatus_id, ap_propertytype_id from cm_appln_valdetl, cm_appln_parameter, cm_masterlist
                left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") zone
                on zone.tdi_key = ma_subzone_id
                where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_va_id = basketid
                and (SELECT trate_value
                FROM cm_tone_taxrate
                WHERE (trate_trlist_id   = tonetaxid)
                AND (trate_zon_id    = tdi_parent_key)
                AND (trate_ishasbuilding_id        = ap_bldgstatus_id)
                AND (trate_proptype_id        = ap_propertytype_id)) IS NULL group by   tdi_parent_key, ap_bldgstatus_id, ap_propertytype_id;
                
                
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manaual_bldg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manaual_bldg`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
declare l_bldg_no varchar(15);
DECLARE l_subzone varchar(5);
declare l_bldgtype_id varchar(10) ;
declare l_bldgstorey_id varchar(10) ;
declare l_bldgcondn_id varchar(2) ;
declare l_bldgposition_id varchar(4) ;
declare l_bldgstructure_id varchar(2) ;
declare l_rooftype_id varchar(2) ;
declare l_walltype_id varchar(2) ;
declare l_floortype_id varchar(2) ;
declare l_bldgcategory_id varchar(2) ;
declare l_cccdate date ;
declare l_occupieddate date ;
declare l_ismainbldg_id varchar(1);
DECLARE l_vd_id INT;
DECLARE l_bldgcount INT;
DECLARE l_bldgid INT;
DECLARE l_valbldgid INT;
DECLARE l_newbldgarid INT;
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE v_finished2 INTEGER DEFAULT 0;
DECLARE l_ref varchar(50);
DECLARE l_areatype_id varchar(5) ;
DECLARE l_arealevel_id varchar(3) ;
DECLARE l_areacategory_id varchar(5) ;
DECLARE l_areazone_id varchar(5) ;
DECLARE l_areause_id varchar(3) ;
DECLARE l_areadesc varchar(255) ;
DECLARE l_dimention varchar(255) ;
DECLARE l_unitcount smallint(6) ;
DECLARE l_size float ;
DECLARE l_sizeunit_id varchar(5) ;
DECLARE l_totsize float ;
DECLARE l_bldgtonevalue float ;
DECLARE l_bldgallowancetonevalue float ;
DECLARE l_arfloortype_id varchar(2);
DECLARE l_arwalltype_id varchar(2);
DECLARE l_ceilingtype_id varchar(2);
DECLARE l_bldgargrossvalue float ;
DECLARE l_totalbldgargrossvalue float ;
DECLARE l_bldgarnetvalue float ;
DECLARE l_grossallowance float ;
DECLARE l_grossnet float ;
DECLARE l_grossroundnet float ;
DECLARE l_depreciationrate float ;
DECLARE l_bldgdepreciationvalue float ;
DECLARE l_netnt float ;
DECLARE l_roundnetnt float ;
DECLARE l_depreciationvalue float ;
DECLARE l_flag varchar(5) ;
DECLARE bldgardone BOOLEAN DEFAULT FALSE; 


DEClARE bldg_cursor CURSOR FOR 
select vd_id,ab_id,ma_subzone_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id, ab_bldgcondn_id, 
ab_bldgposition_id, 
ab_bldgstructure_id ,ab_rooftype_id ,ab_walltype_id, ab_floortype_id, ab_cccdate, ab_occupieddate, 
ab_ismainbldg_id 
from cm_appln_valdetl inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id inner join cm_appln_bldg on ab_vd_id = vd_id
where  vd_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');

DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

OPEN bldg_cursor;
	get_bldg: LOOP
		IF v_finished = 1 THEN 
			LEAVE get_bldg;
		END IF;
		 FETCH bldg_cursor INTO l_vd_id, l_bldgid,l_subzone, l_bldg_no,  l_bldgtype_id,  l_bldgstorey_id, 
         l_bldgcondn_id, l_bldgposition_id, l_bldgstructure_id, l_rooftype_id, l_walltype_id, 
         l_floortype_id,	l_cccdate, l_occupieddate, l_ismainbldg_id;
		 set l_totalbldgargrossvalue = 0;
         
         select tdi_parent_key into l_bldgcategory_id from tbdefitems where tdi_td_name = "BULDINGTYPE"
         and tdi_key = l_bldgtype_id  limit 1;
         
          select count(*) into l_bldgcount from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id limit 1;
              if l_bldgcount = 0 then 
                
				INSERT INTO `cm_appln_val_bldg`
				(`vb_vd_id`,`vb_bldg_no`,`vb_bldgtype_id`,`vb_bldgstorey_id`,`vb_bldgcondn_id`,`vb_bldgposition_id`,
				`vb_bldgstructure_id`,`vb_rooftype_id`,`vb_walltype_id`,`vb_floortype_id`,`vb_cccdate`,
				`vb_occupieddate`,`vb_ismainbldg_id`,
				`vb_createby`,`vb_createdate`,`vb_updateby`,`vb_updatedate`)
				VALUES(l_vd_id, l_bldg_no,l_bldgtype_id,l_bldgstorey_id,l_bldgcondn_id,l_bldgposition_id,l_bldgstructure_id,
				l_rooftype_id
				,l_walltype_id,l_floortype_id,l_cccdate,l_occupieddate,l_ismainbldg_id
				,p_username,	NOW(),p_username,NOW());
					SELECT LAST_INSERT_ID() into l_valbldgid;
			else
         
				select vb_id into l_valbldgid from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id ;
         
			end if;
		
        BLOCK2: begin
			DEClARE bldgar_cursor CURSOR FOR 
			select aba_ref,aba_areatype_id,aba_arealevel_id,aba_areacategory_id,aba_areazone_id,aba_areause_id,aba_areadesc,
			aba_dimention,aba_unitcount,aba_size,aba_sizeunit_id,aba_totsize,aba_floortype_id,aba_walltype_id,aba_ceilingtype_id
			from cm_appln_bldg, cm_appln_bldgarea
			where aba_ab_id = ab_id and aba_ab_id = l_bldgid and ab_vd_id = l_vd_id;           
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished2 = 1;
            
			OPEN bldgar_cursor;
            bldgarea_loop: LOOP		
					
                FETCH bldgar_cursor INTO l_ref, l_areatype_id, l_arealevel_id,
                l_areacategory_id, l_areazone_id,  l_areause_id, l_areadesc, l_dimention,
                l_unitcount, l_size, l_sizeunit_id, l_totsize, l_arfloortype_id, l_arwalltype_id,
                l_ceilingtype_id;
         
                SELECT   tbldg_value into l_bldgtonevalue
				FROM cm_tone_building where  tbldg_subzon_id = l_subzone and     tbldg_proptype_id = l_bldgtype_id and
				tbldg_propstorey_id = l_bldgstorey_id and
				tbldg_areatype_id = l_areatype_id and  tbldg_arealevel_id = l_arealevel_id and  
				tbldg_areacategory_id = l_areacategory_id and  tbldg_areause_id = l_areause_id 
				and tbldg_transtype_id = 2
                and tbldg_tone_id = p_tonebasket  limit 1;
				
         
               
                if l_bldgtonevalue is not null then               
					set l_flag = 'Y';
                    select count(*) into l_newbldgarid from `cm_appln_val_bldgarea` where `vba_vb_id` = l_valbldgid and `vba_ref` = l_ref and
                    `vba_areatype_id` = l_areatype_id and `vba_arealevel_id` = l_arealevel_id and `vba_areacategory_id`= l_areacategory_id and 
                    `vba_areause_id`= l_areause_id and 
					`vba_areadesc`= l_areadesc and `vba_unitcount`= l_unitcount and `vba_size`= l_size and 
                    `vba_sizeunit_id`= l_sizeunit_id and `vba_totsize` = l_totsize;
                    
                    IF l_newbldgarid = 0 THEN
                    
						set l_bldgargrossvalue = l_totsize * l_bldgtonevalue;
						set l_bldgarnetvalue = l_bldgargrossvalue;
						set l_totalbldgargrossvalue = l_totalbldgargrossvalue + l_bldgargrossvalue;
						
						INSERT INTO `cm_appln_val_bldgarea`
						(`vba_vb_id`,`vba_ref`,`vba_areatype_id`,`vba_arealevel_id`,`vba_areacategory_id`,`vba_areause_id`,
						`vba_areadesc`,`vba_unitcount`,`vba_size`,`vba_sizeunit_id`,`vba_totsize`,`vba_createby`,`vba_createdate`,`vba_updateby`,
						`vba_updatedate`)
						VALUES(l_valbldgid,l_ref, l_areatype_id, l_arealevel_id,
						l_areacategory_id,  l_areause_id, l_areadesc, 
						l_unitcount, l_size, l_sizeunit_id, l_totsize
						,p_username,	NOW(),p_username,NOW());
                    END IF;
                end if;
                IF v_finished2 = 1 THEN 
                  
					LEAVE bldgarea_loop;                    
				END IF;
			END LOOP bldgarea_loop;
            
			
               
                    SELECT 
				tallo_value into l_bldgallowancetonevalue
				FROM cm_tone_bldg_allowances where  tallo_allowancetype_id = l_bldgposition_id
				and  tallo_buldingcategory_id = l_bldgcategory_id and tallo_tone_id = p_tonebasket  limit 1;
                if l_bldgallowancetonevalue is null then
					set l_bldgallowancetonevalue =  0;
                end if;
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                if l_bldgposition_id is not null then
					INSERT INTO `cm_appln_val_bldgallowances`
					(`vbal_vb_id`,`vbal_allowancetype_id`,`vbal_calcmethod_id`,`vbal_drivevalue`,`vbal_createby`,`vbal_createdate`,`vbal_updateby`,`vbal_updatedate`)
					VALUES(l_valbldgid,l_bldgposition_id,'1',l_bldgallowancetonevalue, p_username,	NOW(),p_username,NOW() );
					end if;
                    SELECT `tdepre_value` into l_depreciationvalue
					FROM `cm_tone_bldg_depreciation` where tdepre_bldgcondn_id = l_bldgcondn_id 
                    and tdepre_tone_id = p_tonebasket limit 1;
                    
                    set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =   roundoff(l_netnt, 1); 
						
				
			
                        
	
          CLOSE bldgar_cursor;
		end BLOCK2; 
        
        
    
	END LOOP get_bldg;
    
 CLOSE bldg_cursor;
 SELECT count(*) into l_bldgcount  FROM cama.cm_appln_val_bldg where vb_netnt = 0;
 SELECT vb_id, vb_depreciationvalue into l_bldgid, l_depreciationvalue  FROM cm_appln_val_bldg
 inner join cm_appln_valdetl on vd_id = vb_vd_id where vb_netnt = 0  and p_valuationbasket = p_valuationbasket and  vd_approvalstatus_id in ('06','07') limit 1;
 SELECT sum(vba_grossareavalue) into l_totalbldgargrossvalue from cm_appln_val_bldgarea
 where vba_vb_id = l_bldgid ;
 SELECT vbal_drivevalue, vbal_id into l_bldgallowancetonevalue,l_vd_id from cm_appln_val_bldgallowances
 where vbal_grossallowancevalue = 0 and vbal_vb_id = l_bldgid limit 1;
 if l_bldgcount > 0 then
 
		
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                
            
                
                 set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =   roundoff(l_netnt, 1); 
				
 end if;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manaual_bldg2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manaual_bldg2`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
declare l_bldg_no varchar(15);
DECLARE l_subzone varchar(5);
declare l_bldgtype_id varchar(10) ;
declare l_bldgstorey_id varchar(10) ;
declare l_bldgcondn_id varchar(2) ;
declare l_bldgposition_id varchar(4) ;
declare l_bldgstructure_id varchar(2) ;
declare l_rooftype_id varchar(2) ;
declare l_walltype_id varchar(2) ;
declare l_floortype_id varchar(2) ;
declare l_bldgcategory_id varchar(2) ;
declare l_cccdate date ;
declare l_occupieddate date ;
declare l_ismainbldg_id varchar(1);
DECLARE l_vd_id INT;
DECLARE l_bldgcount INT;
DECLARE l_bldgid INT;
DECLARE l_valbldgid INT;
DECLARE l_newbldgarid INT;
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE v_finished2 INTEGER DEFAULT 0;
DECLARE l_ref varchar(50);
DECLARE l_areatype_id varchar(5) ;
DECLARE l_arealevel_id varchar(3) ;
DECLARE l_areacategory_id varchar(5) ;
DECLARE l_areazone_id varchar(5) ;
DECLARE l_areause_id varchar(3) ;
DECLARE l_areadesc varchar(255) ;
DECLARE l_dimention varchar(255) ;
DECLARE l_unitcount smallint(6) ;
DECLARE l_size float ;
DECLARE l_sizeunit_id varchar(5) ;
DECLARE l_totsize float ;
DECLARE l_bldgtonevalue float ;
DECLARE l_bldgallowancetonevalue float ;
DECLARE l_arfloortype_id varchar(2);
DECLARE l_arwalltype_id varchar(2);
DECLARE l_ceilingtype_id varchar(2);
DECLARE l_bldgargrossvalue float ;
DECLARE l_totalbldgargrossvalue float ;
DECLARE l_bldgarnetvalue float ;
DECLARE l_grossallowance float ;
DECLARE l_grossnet float ;
DECLARE l_grossroundnet float ;
DECLARE l_depreciationrate float ;
DECLARE l_bldgdepreciationvalue float ;
DECLARE l_netnt float ;
DECLARE l_roundnetnt float ;
DECLARE l_depreciationvalue float ;
DECLARE l_flag varchar(5) ;
DECLARE bldgardone BOOLEAN DEFAULT FALSE; 


DEClARE bldg_cursor CURSOR FOR 
select vd_id,ab_id,ma_subzone_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id, ab_bldgcondn_id, 
ab_bldgposition_id, 
ab_bldgstructure_id ,ab_rooftype_id ,ab_walltype_id, ab_floortype_id, ab_cccdate, ab_occupieddate, 
ab_ismainbldg_id 
from cm_appln_valdetl inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id inner join cm_appln_bldg on ab_vd_id = vd_id
where  vd_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07') and  ap_bldgstatus_id = 1;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

OPEN bldg_cursor;
	get_bldg: LOOP
		IF v_finished = 1 THEN 
			LEAVE get_bldg;
		END IF;
		 FETCH bldg_cursor INTO l_vd_id, l_bldgid,l_subzone, l_bldg_no,  l_bldgtype_id,  l_bldgstorey_id, 
         l_bldgcondn_id, l_bldgposition_id, l_bldgstructure_id, l_rooftype_id, l_walltype_id, 
         l_floortype_id,	l_cccdate, l_occupieddate, l_ismainbldg_id;
		 set l_totalbldgargrossvalue = 0;
         
         select tdi_parent_key into l_bldgcategory_id from tbdefitems where tdi_td_name = "BULDINGTYPE"
         and tdi_key = l_bldgtype_id ;
         
          select count(*) into l_bldgcount from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id;
              if l_bldgcount = 0 then 
                
				INSERT INTO `cm_appln_val_bldg`
				(`vb_vd_id`,`vb_bldg_no`,`vb_bldgtype_id`,`vb_bldgstorey_id`,`vb_bldgcondn_id`,`vb_bldgposition_id`,
				`vb_bldgstructure_id`,`vb_rooftype_id`,`vb_walltype_id`,`vb_floortype_id`,`vb_cccdate`,
				`vb_occupieddate`,`vb_ismainbldg_id`,
				`vb_createby`,`vb_createdate`,`vb_updateby`,`vb_updatedate`)
				VALUES(l_vd_id, l_bldg_no,l_bldgtype_id,l_bldgstorey_id,l_bldgcondn_id,l_bldgposition_id,l_bldgstructure_id,
				l_rooftype_id
				,l_walltype_id,l_floortype_id,l_cccdate,l_occupieddate,l_ismainbldg_id
				,p_username,	NOW(),p_username,NOW());
					SELECT LAST_INSERT_ID() into l_valbldgid;
			else
         
				select vb_id into l_valbldgid from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id ;
         
			end if;
		
        BLOCK2: begin
			DEClARE bldgar_cursor CURSOR FOR 
			select aba_ref,aba_areatype_id,aba_arealevel_id,aba_areacategory_id,aba_areazone_id,aba_areause_id,aba_areadesc,
			aba_dimention,aba_unitcount,aba_size,aba_sizeunit_id,aba_totsize,aba_floortype_id,aba_walltype_id,aba_ceilingtype_id
			from cm_appln_bldg, cm_appln_bldgarea
			where aba_ab_id = ab_id and aba_ab_id = l_bldgid and ab_vd_id = l_vd_id;           
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished2 = 1;
            
			OPEN bldgar_cursor;
            bldgarea_loop: LOOP		
					
                FETCH bldgar_cursor INTO l_ref, l_areatype_id, l_arealevel_id,
                l_areacategory_id, l_areazone_id,  l_areause_id, l_areadesc, l_dimention,
                l_unitcount, l_size, l_sizeunit_id, l_totsize, l_arfloortype_id, l_arwalltype_id,
                l_ceilingtype_id;
         
                SELECT   tbldg_value into l_bldgtonevalue
				FROM cm_tone_building where  tbldg_subzon_id = l_subzone and     tbldg_proptype_id = l_bldgtype_id and
				tbldg_propstorey_id = l_bldgstorey_id and
				tbldg_areatype_id = l_areatype_id and  tbldg_arealevel_id = l_arealevel_id and  
				tbldg_areacategory_id = l_areacategory_id and  tbldg_areause_id = l_areause_id 
				and tbldg_transtype_id = 2
                and tbldg_tone_id = p_tonebasket ;
				
         
               
                if l_bldgtonevalue is not null then               
					set l_flag = 'Y';
                    select count(*) into l_newbldgarid from `cm_appln_val_bldgarea` where `vba_vb_id` = l_valbldgid and `vba_ref` = l_ref and
                    `vba_areatype_id` = l_areatype_id and `vba_arealevel_id` = l_arealevel_id and `vba_areacategory_id`= l_areacategory_id and 
                    `vba_areause_id`= l_areause_id and 
					`vba_areadesc`= l_areadesc and `vba_unitcount`= l_unitcount and `vba_size`= l_size and 
                    `vba_sizeunit_id`= l_sizeunit_id and `vba_totsize` = l_totsize;
                    
                    IF l_newbldgarid = 0 THEN
                    
						set l_bldgargrossvalue = l_totsize * l_bldgtonevalue;
						set l_bldgarnetvalue = l_bldgargrossvalue;
						set l_totalbldgargrossvalue = l_totalbldgargrossvalue + l_bldgargrossvalue;
						
						INSERT INTO `cm_appln_val_bldgarea`
						(`vba_vb_id`,`vba_ref`,`vba_areatype_id`,`vba_arealevel_id`,`vba_areacategory_id`,`vba_areause_id`,
						`vba_areadesc`,`vba_unitcount`,`vba_size`,`vba_sizeunit_id`,`vba_totsize`,`vba_createby`,`vba_createdate`,`vba_updateby`,
						`vba_updatedate`)
						VALUES(l_valbldgid,l_ref, l_areatype_id, l_arealevel_id,
						l_areacategory_id,  l_areause_id, l_areadesc, 
						l_unitcount, l_size, l_sizeunit_id, l_totsize
						,p_username,	NOW(),p_username,NOW());
                    END IF;
                end if;
                IF v_finished2 = 1 THEN 
                  
					LEAVE bldgarea_loop;                    
				END IF;
			END LOOP bldgarea_loop;
            
			
               
                    SELECT 
				tallo_value into l_bldgallowancetonevalue
				FROM cm_tone_bldg_allowances where  tallo_allowancetype_id = l_bldgposition_id
				and  tallo_buldingcategory_id = l_bldgcategory_id and tallo_tone_id = p_tonebasket ;
                if l_bldgallowancetonevalue is null then
					set l_bldgallowancetonevalue =  0;
                end if;
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                if l_bldgposition_id is not null then
					INSERT INTO `cm_appln_val_bldgallowances`
					(`vbal_vb_id`,`vbal_allowancetype_id`,`vbal_calcmethod_id`,`vbal_drivevalue`,`vbal_createby`,`vbal_createdate`,`vbal_updateby`,`vbal_updatedate`)
					VALUES(l_valbldgid,l_bldgposition_id,'1',l_bldgallowancetonevalue, p_username,	NOW(),p_username,NOW() );
					end if;
                    SELECT `tdepre_value` into l_depreciationvalue
					FROM `cm_tone_bldg_depreciation` where tdepre_bldgcondn_id = l_bldgcondn_id 
                    and tdepre_tone_id = p_tonebasket limit 1;
                    
                    set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =  FLOOR(l_netnt / 100)*100;
						
				
			
                        
	
          CLOSE bldgar_cursor;
		end BLOCK2; 
        
        
    
	END LOOP get_bldg;
    
 CLOSE bldg_cursor;
 SELECT count(*) into l_bldgcount  FROM cama.cm_appln_val_bldg where vb_netnt = 0;
 SELECT vb_id, vb_depreciationvalue into l_bldgid, l_depreciationvalue  FROM cm_appln_val_bldg
 inner join cm_appln_valdetl on vd_id = vb_vd_id where vb_netnt = 0  and p_valuationbasket = p_valuationbasket and  vd_approvalstatus_id in ('06','07') limit 1;
 SELECT sum(vba_grossareavalue) into l_totalbldgargrossvalue from cm_appln_val_bldgarea
 where vba_vb_id = l_bldgid ;
 SELECT vbal_drivevalue, vbal_id into l_bldgallowancetonevalue,l_vd_id from cm_appln_val_bldgallowances
 where vbal_grossallowancevalue = 0 and vbal_vb_id = l_bldgid limit 1;
 if l_bldgcount > 0 then
 
		
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                
            
                
                 set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =  FLOOR(l_netnt / 100)*100;
				
 end if;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manaual_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manaual_tax`(p_valuationbasket int, p_tonebasket int,drivedrate float,drivedvalue float, p_username varchar(255))
BEGIN
	DECLARE l_grossvalue float;
	DECLARE l_valuedescretion float;
	DECLARE l_proposednt float; 
	DECLARE l_proposedrate float; 
	DECLARE l_calculatedrate float; 
	DECLARE l_proposedtax float; 
	DECLARE l_approvednt float; 
	DECLARE l_approvedrate float; 
	DECLARE l_adjustment float; 
	DECLARE l_approvedtax float; 
	DECLARE l_note text;
    DECLARE v_finished int default 0;
    DECLARE l_taxrate float;
    DECLARE l_landvalue float;
    DECLARE l_bldgvalue float;
    DECLARE l_additionalvalue float;
    DECLARE l_propid int;
    DECLARE l_zone varchar(10);
    DECLARE l_bldgstatus varchar(10);
    DECLARE l_proptype varchar(10);
    
	DECLARE property_cursor CURSOR FOR 
	select vd_id, tdi_parent_key, ap_bldgstatus_id, ap_propertytype_id from cm_appln_valdetl, cm_appln_parameter, cm_masterlist
	left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") zone
	on zone.tdi_key = ma_subzone_id
	where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');
	
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
		
	OPEN property_cursor;
	
    get_data: LOOP
		
        FETCH property_cursor INTO l_propid, l_zone, l_bldgstatus, l_proptype;
		IF v_finished = 1 THEN 
			LEAVE get_data;
		END IF;
        
        select trate_value into l_taxrate from cm_tone_taxrate where trate_zon_id = l_zone and 
		trate_ishasbuilding_id = l_bldgstatus and trate_proptype_id = l_proptype and trate_trlist_id = p_tonebasket;
        
        select sum(vl_roundnetlandvalue) into l_landvalue from cm_appln_val_lot where vl_vd_id = l_propid;
       
        select sum(vb_roundnetnt) into l_bldgvalue from cm_appln_val_bldg where vb_vd_id = l_propid;
        
        select sum(vad_roundnetvalue) into l_additionalvalue from cm_appln_val_additional where vad_vd_id = l_propid;
        set l_grossvalue = 0;
        set l_proposednt = 0;
        set l_proposedtax = 0;
        if l_taxrate is not null then
			set l_valuedescretion = 0;
           
            
           
           if l_bldgstatus = 0 then
			 set l_grossvalue = l_landvalue +  l_additionalvalue + l_valuedescretion;
				if l_termtype = 2 then
					set l_grossvalue = ( l_grossvalue * ( drivedrate /100));
				end if;
				
            else
            set l_grossvalue = (l_bldgvalue * 12)  +  l_additionalvalue + l_valuedescretion;
				
            
           end if; 
           
           
            if l_grossvalue < 1000 then 
				set l_proposednt =  roundoff(l_grossvalue, 1); 
			else
				set l_proposednt =  roundoff(l_grossvalue, 1); 
            end if;
            
            
            set l_calculatedrate = 100;
            set l_adjustment = 0;
            set l_proposedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100);
            set l_approvedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100) + l_adjustment;
            INSERT INTO `cm_appln_val_tax`
			(`vt_vd_id`,`vt_grossvalue`,`vt_valuedescretion`,`vt_createby`,
			`vt_createdate`,`vt_updateby`,`vt_updatedate`)
			VALUES(l_propid,l_grossvalue, l_valuedescretion,p_username, now(),p_username, now());
        end if;
        
    END LOOP get_data;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manaual_tax2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manaual_tax2`(p_valuationbasket int, p_tonebasket int,drivedrate float,drivedvalue float, p_username varchar(255))
BEGIN
	DECLARE l_grossvalue float;
	DECLARE l_valuedescretion float;
	DECLARE l_proposednt float; 
	DECLARE l_proposedrate float; 
	DECLARE l_calculatedrate float; 
	DECLARE l_proposedtax float; 
	DECLARE l_approvednt float; 
	DECLARE l_approvedrate float; 
	DECLARE l_adjustment float; 
	DECLARE l_approvedtax float; 
	DECLARE l_note text;
    DECLARE v_finished int default 0;
    DECLARE l_taxrate float;
    DECLARE l_landvalue float;
    DECLARE l_bldgvalue float;
    DECLARE l_additionalvalue float;
    DECLARE l_propid int;
    DECLARE l_zone varchar(10);
    DECLARE l_bldgstatus varchar(10);
    DECLARE l_proptype varchar(10);
    
	DECLARE property_cursor CURSOR FOR 
	select vd_id, tdi_parent_key, ap_bldgstatus_id, ap_propertytype_id from cm_appln_valdetl, cm_appln_parameter, cm_masterlist
	left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") zone
	on zone.tdi_key = ma_subzone_id
	where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');
	
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
		
	OPEN property_cursor;
	
    get_data: LOOP
		
        FETCH property_cursor INTO l_propid, l_zone, l_bldgstatus, l_proptype;
		IF v_finished = 1 THEN 
			LEAVE get_data;
		END IF;
        
        select trate_value into l_taxrate from cm_tone_taxrate where trate_zon_id = l_zone and 
		trate_ishasbuilding_id = l_bldgstatus and trate_proptype_id = l_proptype and trate_trlist_id = p_tonebasket  limit 1;
        
        select ifnull(sum(vl_roundnetlandvalue),0) into l_landvalue from cm_appln_val_lot where vl_vd_id = l_propid  limit 1;
       
        select ifnull(sum(vb_roundnetnt),0) into l_bldgvalue from cm_appln_val_bldg where vb_vd_id = l_propid limit 1;
        
        select ifnull(sum(vad_roundnetvalue),0) into l_additionalvalue from cm_appln_val_additional where vad_vd_id = l_propid limit 1;
        set l_grossvalue = 0;
        set l_proposednt = 0;
        set l_proposedtax = 0;
        if l_taxrate is not null then
			set l_valuedescretion = 0;
           
            
           
          
            set l_grossvalue = l_landvalue + (l_bldgvalue * 12)  +  l_additionalvalue + l_valuedescretion;
				
            
           
           
            if l_grossvalue < 1000 then 
				set l_proposednt = FLOOR(l_grossvalue / 50)*50;
			else
				set l_proposednt = FLOOR(l_grossvalue / 1000)*1000;
            end if;
            
            
            set l_calculatedrate = 100;
            set l_adjustment = 0;
            set l_proposedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100);
            set l_approvedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100) + l_adjustment;
            INSERT INTO `cm_appln_val_tax`
			(`vt_vd_id`,`vt_grossvalue`,`vt_valuedescretion`,`vt_createby`,
			`vt_createdate`,`vt_updateby`,`vt_updatedate`)
			VALUES(l_propid,l_grossvalue, l_valuedescretion,p_username, now(),p_username, now());
        end if;
        
    END LOOP get_data;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manual_lot` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manual_lot`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_vd_id int;
DECLARE l_subzone varchar(5);
DECLARE l_bldgtype varchar(5);
DECLARE l_proptype varchar(5);
DECLARE l_propcategory varchar(5);
DECLARE l_propertylevel varchar(5);
DECLARE l_state varchar(2);
DECLARE l_mbp varchar(20);
DECLARE l_ptss varchar(3);
DECLARE l_lotcode_id varchar(2);
DECLARE l_no varchar(15);
DECLARE l_altno varchar(15);
DECLARE l_titletype_id varchar(3);
DECLARE l_titleno varchar(8);
DECLARE l_alttitleno varchar(8);
DECLARE l_size float(15,4);
DECLARE l_sizeunit_id varchar(2);
DECLARE l_landcondition_id varchar(4);
DECLARE l_landposision_id varchar(4);
DECLARE l_roadtype_id varchar(3);
DECLARE l_roadcategory_id varchar(3);
DECLARE l_landuse_id varchar(4);
DECLARE l_excd text;
DECLARE l_rtit text;
DECLARE l_tenuretype_id varchar(3);
DECLARE l_tenureperiod int(3);
DECLARE l_startdate date;
DECLARE l_expireddate date;
DECLARE l_activeind_id varchar(4); 
DECLARE landrate float;
DECLARE l_standardarea float;
DECLARE l_nextarea float;
DECLARE l_maxlevel float;
DECLARE l_grossvalue float;
DECLARE l_roundnetareavalue float;
DECLARE l_totalgrossarea float;
DECLARE l_totalroundnetarea float;
DECLARE l_discount float default 20;
declare l_count int default 1;
declare l_lotid int default 0;
declare tonecount int default 0;
DECLARE llanarea float default 0;
DECLARE copylanarea float;
DECLARE l_discounttmp INT;
DECLARE l_islast INT default 0;
DECLARE i int;
 
	DEClARE lot_cursor CURSOR FOR 
		select vd_id,ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id, al_state, al_lotcode_id, al_no, al_altno, al_titletype_id,
		al_titleno, al_alttitleno, al_size, al_sizeunit_id, al_landcondition_id, al_landposision_id, al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id, al_tenureperiod,
		al_startdate, al_expireddate, al_activeind_id from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id
        inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id
		where vd_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');
    
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
    OPEN lot_cursor;
    
    
	get_lot: LOOP
		
		FETCH lot_cursor INTO l_vd_id, l_subzone, l_bldgtype,  l_propcategory, l_proptype, l_propertylevel, l_state, l_lotcode_id, l_no, l_altno, l_titletype_id, l_titleno,
		l_alttitleno, l_size, l_sizeunit_id, l_landcondition_id, l_landposision_id,	l_roadtype_id, l_roadcategory_id, l_landuse_id, l_excd, l_rtit,
		l_tenuretype_id, l_tenureperiod, l_startdate, l_expireddate, l_activeind_id;
        
		set copylanarea = l_size;
        
		IF v_finished = 1 THEN 
			LEAVE get_lot;
		END IF;
         
		select tland_value into landrate from cm_tone_land where tland_ishasbuilding_id = l_bldgtype and tland_subzon_id = l_subzone 
        and  tland_proptype_id = l_proptype and tland_propstorey_id = l_propertylevel and tland_tone_id = p_tonebasket;

		select tstand_standartarea, tstand_nextarea, tstand_maxlevel into l_standardarea, l_nextarea, l_maxlevel from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
		select count(*) into tonecount from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
        
        set llanarea = l_size;
        set l_discount = 100;
        set l_discounttmp = 100;
        
        if (tonecount > 0) then
			SET l_count = 1;
			INSERT INTO `cm_appln_val_lot`(`vl_vd_id` ,`vl_lotcode_id`,`vl_no`,
			`vl_altno`,`vl_titletype_id`, `vl_titleno`,	`vl_alttitleno`,`vl_size`,`vl_sizeunit_id`,
			`vl_standardarea`,`vl_nextarea`,`vl_maxlevel`,`vl_landcondition_id`,`vl_landposision_id`,
			`vl_roadtype_id`,`vl_roadcategory_id`,`vl_landuse_id`,	`vl_tenuretype_id`,`vl_tenureperiod`,`vl_startdate`,
			`vl_expireddate`,`vl_createby`,	`vl_createdate`,`vl_updateby`,`vl_updatedate`) 
            VALUES (l_vd_id ,l_lotcode_id,l_no,	l_altno, l_titletype_id, l_titleno,	l_alttitleno,
            copylanarea,l_sizeunit_id,	l_standardarea,l_nextarea,l_maxlevel,
			l_landcondition_id,l_landposision_id,	l_roadtype_id,l_roadcategory_id,l_landuse_id,
			l_tenuretype_id,l_tenureperiod, l_startdate,l_expireddate,p_username,	NOW(),p_username,NOW());
			SELECT LAST_INSERT_ID() into l_lotid;
            
            
            
				BLOCK2: begin
				declare l_currseq int default 0;
                declare l_stdesc varchar(255);
                declare l_initdiscount int default 10;
                declare l_currdiscount int default 0;
                declare l_balancearea float default 0;
                declare l_currarea float default 0;
                declare dummy float;
                
                set l_balancearea = l_size;
                set l_currarea = l_balancearea;


		standardarea_loop: LOOP		

						
						if l_currseq < l_maxlevel and l_balancearea > 0 then
							set dummy = 0;
                        else
                        
							LEAVE standardarea_loop;
                        end if;
                        
                        if l_currseq = 0 then
							set l_stdesc = 'Main Area';
                            set l_currdiscount = 0;
                        else
							set l_stdesc = concat('Additional Area ' ,l_currseq);
                            set l_currdiscount = l_initdiscount + (l_currseq * 10);
                        end if;
                     
                        
                        if l_currseq = 0 then
							if l_standardarea <> 0 then
								If l_balancearea < l_standardarea then
									set l_currarea = l_balancearea;
									set l_balancearea = 0;
                                else
									set l_currarea = l_standardarea;
									set l_balancearea = l_balancearea - l_currarea;
                                end if;
                            else
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            end if;
						elseif l_currseq > 0 And l_currseq <= l_maxlevel - 1 then
							If l_balancearea < l_nextarea then
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            else
								set l_currarea = l_nextarea;
								set l_balancearea = l_balancearea - l_nextarea;
                            end if;
                        elseif  l_currseq = l_maxlevel then
							set l_currarea = l_balancearea;
							set l_balancearea = 0;
                        end if;
						
                        set l_grossvalue = l_currarea * landrate * ( 100 - l_currdiscount)/100;
						set l_roundnetareavalue =  roundoff(l_grossvalue, 1); 
						
                            
                            INSERT INTO `cm_appln_val_lotarea`
				(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,
				`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
				VALUES
				(l_lotid, 0,l_stdesc,l_currarea,
				p_username, now(), p_username, now() );
                            
					set l_currseq = l_currseq + 1;
							
						
						
				END LOOP standardarea_loop;
				end BLOCK2;            
			
			
		end if;
	END LOOP get_lot;
 
 CLOSE lot_cursor;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manual_lot2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manual_lot2`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_vd_id int;
DECLARE l_subzone varchar(5);
DECLARE l_bldgtype varchar(5);
DECLARE l_proptype varchar(5);
DECLARE l_propcategory varchar(5);
DECLARE l_propertylevel varchar(5);
DECLARE l_state varchar(2);
DECLARE l_mbp varchar(20);
DECLARE l_ptss varchar(3);
DECLARE l_lotcode_id varchar(2);
DECLARE l_no varchar(15);
DECLARE l_altno varchar(15);
DECLARE l_titletype_id varchar(3);
DECLARE l_titleno varchar(8);
DECLARE l_alttitleno varchar(8);
DECLARE l_size float(15,4);
DECLARE l_sizeunit_id varchar(2);
DECLARE l_landcondition_id varchar(4);
DECLARE l_landposision_id varchar(4);
DECLARE l_roadtype_id varchar(3);
DECLARE l_roadcategory_id varchar(3);
DECLARE l_landuse_id varchar(4);
DECLARE l_excd text;
DECLARE l_rtit text;
DECLARE l_tenuretype_id varchar(3);
DECLARE l_tenureperiod int(3);
DECLARE l_startdate date;
DECLARE l_expireddate date;
DECLARE l_activeind_id varchar(4); 
DECLARE landrate float;
DECLARE l_standardarea float;
DECLARE l_nextarea float;
DECLARE l_maxlevel float;
DECLARE l_grossvalue float;
DECLARE l_roundnetareavalue float;
DECLARE l_totalgrossarea float;
DECLARE l_totalroundnetarea float;
DECLARE l_discount float default 20;
declare l_count int default 1;
declare l_lotid int default 0;
declare tonecount int default 0;
DECLARE llanarea float default 0;
DECLARE copylanarea float;
DECLARE l_discounttmp INT;
DECLARE l_islast INT default 0;
DECLARE i int;
 
	DEClARE lot_cursor CURSOR FOR 
		select vd_id,ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id, al_state, al_lotcode_id, al_no, al_altno, al_titletype_id,
		al_titleno, al_alttitleno, al_size, al_sizeunit_id, al_landcondition_id, al_landposision_id, al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id, al_tenureperiod,
		al_startdate, al_expireddate, al_activeind_id from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id
        inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id
		where vd_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07') and  ap_bldgstatus_id = 0 ;
    
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
    OPEN lot_cursor;
    
    
	get_lot: LOOP
		
		FETCH lot_cursor INTO l_vd_id, l_subzone, l_bldgtype,  l_propcategory, l_proptype, l_propertylevel, l_state, l_lotcode_id, l_no, l_altno, l_titletype_id, l_titleno,
		l_alttitleno, l_size, l_sizeunit_id, l_landcondition_id, l_landposision_id,	l_roadtype_id, l_roadcategory_id, l_landuse_id, l_excd, l_rtit,
		l_tenuretype_id, l_tenureperiod, l_startdate, l_expireddate, l_activeind_id;
        
		set copylanarea = l_size;
        
		IF v_finished = 1 THEN 
			LEAVE get_lot;
		END IF;
         
		select tland_value into landrate from cm_tone_land where tland_ishasbuilding_id = l_bldgtype and tland_subzon_id = l_subzone 
        and  tland_proptype_id = l_proptype and tland_propstorey_id = l_propertylevel and tland_tone_id = p_tonebasket;

		select tstand_standartarea, tstand_nextarea, tstand_maxlevel into l_standardarea, l_nextarea, l_maxlevel from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
		select count(*) into tonecount from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
        
        set llanarea = l_size;
        set l_discount = 100;
        set l_discounttmp = 100;
        
        if (tonecount > 0) then
			SET l_count = 1;
			INSERT INTO `cm_appln_val_lot`(`vl_vd_id` ,`vl_lotcode_id`,`vl_no`,
			`vl_altno`,`vl_titletype_id`, `vl_titleno`,	`vl_alttitleno`,`vl_size`,`vl_sizeunit_id`,
			`vl_standardarea`,`vl_nextarea`,`vl_maxlevel`,`vl_landcondition_id`,`vl_landposision_id`,
			`vl_roadtype_id`,`vl_roadcategory_id`,`vl_landuse_id`,	`vl_tenuretype_id`,`vl_tenureperiod`,`vl_startdate`,
			`vl_expireddate`,`vl_createby`,	`vl_createdate`,`vl_updateby`,`vl_updatedate`) 
            VALUES (l_vd_id ,l_lotcode_id,l_no,	l_altno, l_titletype_id, l_titleno,	l_alttitleno,
            copylanarea,l_sizeunit_id,	l_standardarea,l_nextarea,l_maxlevel,
			l_landcondition_id,l_landposision_id,	l_roadtype_id,l_roadcategory_id,l_landuse_id,
			l_tenuretype_id,l_tenureperiod, l_startdate,l_expireddate,p_username,	NOW(),p_username,NOW());
			SELECT LAST_INSERT_ID() into l_lotid;
            
			
            
            
				BLOCK2: begin
				declare l_currseq int default 0;
                declare l_stdesc varchar(255);
                declare l_initdiscount int default 10;
                declare l_currdiscount int default 0;
                declare l_balancearea float default 0;
                declare l_currarea float default 0;
                declare dummy float;
                
                set l_balancearea = l_size;
                set l_currarea = l_balancearea;


		standardarea_loop: LOOP		

						
						if l_currseq < l_maxlevel and l_balancearea > 0 then
							set dummy = 0;
                        else
                        
							LEAVE standardarea_loop;
                        end if;
                        
                        if l_currseq = 0 then
							set l_stdesc = 'Main Area';
                            set l_currdiscount = 0;
                        else
							set l_stdesc = concat('Additional Area ' ,l_currseq);
                            set l_currdiscount = l_initdiscount + (l_currseq * 10);
                        end if;
                     
                        
                        if l_currseq = 0 then
							if l_standardarea <> 0 then
								If l_balancearea < l_standardarea then
									set l_currarea = l_balancearea;
									set l_balancearea = 0;
                                else
									set l_currarea = l_standardarea;
									set l_balancearea = l_balancearea - l_currarea;
                                end if;
                            else
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            end if;
						elseif l_currseq > 0 And l_currseq <= l_maxlevel - 1 then
							If l_balancearea < l_nextarea then
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            else
								set l_currarea = l_nextarea;
								set l_balancearea = l_balancearea - l_nextarea;
                            end if;
                        elseif  l_currseq = l_maxlevel then
							set l_currarea = l_balancearea;
							set l_balancearea = 0;
                        end if;
						
                        set l_grossvalue = l_currarea * landrate * ( 100 - l_currdiscount)/100;
						set l_roundnetareavalue =  FLOOR(l_grossvalue / 100)*100;
						
                 
                            
                            INSERT INTO `cm_appln_val_lotarea`
				(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,
				`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
				VALUES
				(l_lotid, 0,l_stdesc,l_currarea,
				p_username, now(), p_username, now() );
                            
					set l_currseq = l_currseq + 1;
							
						
						
				END LOOP standardarea_loop;
				end BLOCK2;            
			
            
		end if;
	END LOOP get_lot;
 
 CLOSE lot_cursor;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `manual_lot_test` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `manual_lot_test`(p_valuationbasket int, p_tonebasket int)
BEGIN
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_vd_id int;
DECLARE l_subzone varchar(5);
DECLARE l_bldgtype varchar(5);
DECLARE l_proptype varchar(5);
DECLARE l_propcategory varchar(5);
DECLARE l_propertylevel varchar(5);
DECLARE l_state varchar(2);
DECLARE l_mbp varchar(20);
DECLARE l_ptss varchar(3);
DECLARE l_lotcode_id varchar(2);
DECLARE l_no varchar(15);
DECLARE l_altno varchar(15);
DECLARE l_titletype_id varchar(3);
DECLARE l_titleno varchar(8);
DECLARE l_alttitleno varchar(8);
DECLARE l_size float(15,4);
DECLARE l_sizeunit_id varchar(2);
DECLARE l_landcondition_id varchar(4);
DECLARE l_landposision_id varchar(4);
DECLARE l_roadtype_id varchar(3);
DECLARE l_roadcategory_id varchar(3);
DECLARE l_landuse_id varchar(4);
DECLARE l_excd text;
DECLARE l_rtit text;
DECLARE l_tenuretype_id varchar(3);
DECLARE l_tenureperiod int(3);
DECLARE l_startdate date;
DECLARE l_expireddate date;
DECLARE l_activeind_id varchar(4); 
DECLARE landrate float;
DECLARE l_standardarea float;
DECLARE l_nextarea float;
DECLARE l_maxlevel float;
DECLARE l_grossvalue float;
DECLARE l_roundnetareavalue float;
DECLARE l_totalgrossarea float;
DECLARE l_totalroundnetarea float;
DECLARE l_discount float default 20;
declare l_count int default 1;
declare l_lotid int default 0;
declare tonecount int default 0;
DECLARE llanarea float default 0;
DECLARE copylanarea float;
DECLARE l_discounttmp INT;
DECLARE l_islast INT default 0;
DECLARE i int;
 
	DEClARE lot_cursor CURSOR FOR 
		select vd_id,ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id, al_state, al_lotcode_id, al_no, al_altno, al_titletype_id,
		al_titleno, al_alttitleno, al_size, al_sizeunit_id, al_landcondition_id, al_landposision_id, al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id, al_tenureperiod,
		al_startdate, al_expireddate, al_activeind_id from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id
        inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id
		where vd_id = p_valuationbasket ;
    
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
    OPEN lot_cursor;

CREATE TEMPORARY TABLE  IF NOT EXISTS temp_landstand(
   vla_vt_id int,
   vla_sequent int,
   vla_desc varchar(255),
   vla_area int
);	
		
    
	get_lot: LOOP
		
		FETCH lot_cursor INTO l_vd_id, l_subzone, l_bldgtype,  l_propcategory, l_proptype, l_propertylevel, l_state, l_lotcode_id, l_no, l_altno, l_titletype_id, l_titleno,
		l_alttitleno, l_size, l_sizeunit_id, l_landcondition_id, l_landposision_id,	l_roadtype_id, l_roadcategory_id, l_landuse_id, l_excd, l_rtit,
		l_tenuretype_id, l_tenureperiod, l_startdate, l_expireddate, l_activeind_id;
        
		set copylanarea = l_size;
        
		IF v_finished = 1 THEN 
			LEAVE get_lot;
		END IF;
         
		select tland_value into landrate from cm_tone_land where tland_ishasbuilding_id = l_bldgtype and tland_subzon_id = l_subzone 
        and  tland_proptype_id = l_proptype and tland_propstorey_id = l_propertylevel and tland_tone_id = p_tonebasket;

		select tstand_standartarea, tstand_nextarea, tstand_maxlevel into l_standardarea, l_nextarea, l_maxlevel from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
		select count(*) into tonecount from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
        select l_standardarea, l_nextarea, l_maxlevel, l_size;
        
        if (tonecount > 0) then
			
				BLOCK2: begin
				declare l_currseq int default 0;
                declare l_stdesc varchar(255);
                declare l_initdiscount int default 10;
                declare l_currdiscount int default 0;
                declare l_balancearea float default 0;
                declare l_currarea float default 0;
                declare dummy float;
                
                set l_balancearea = l_size;
                set l_currarea = l_balancearea;


		standardarea_loop: LOOP		

						
						if l_currseq < l_maxlevel and l_balancearea > 0 then
							set dummy = 0;
                        else
                        
							LEAVE standardarea_loop;
                        end if;
                        
                        if l_currseq = 0 then
							set l_stdesc = 'Main Area';
                            set l_currdiscount = 0;
                        else
							set l_stdesc = concat('Additional Area ' ,l_currseq);
                            set l_currdiscount = l_initdiscount + (l_currseq * 10);
                        end if;
                     
                        
                        if l_currseq = 0 then
							if l_standardarea <> 0 then
								If l_balancearea < l_standardarea then
									set l_currarea = l_balancearea;
									set l_balancearea = 0;
                                else
									set l_currarea = l_standardarea;
									set l_balancearea = l_balancearea - l_currarea;
                                end if;
                            else
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            end if;
						elseif l_currseq > 0 And l_currseq <= l_maxlevel - 1 then
							If l_balancearea < l_nextarea then
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            else
								set l_currarea = l_nextarea;
								set l_balancearea = l_balancearea - l_nextarea;
                            end if;
                        elseif  l_currseq = l_maxlevel then
							set l_currarea = l_balancearea;
							set l_balancearea = 0;
                        end if;
						
                        set l_grossvalue = l_currarea * landrate * ( 100 - l_currdiscount)/100;
						set l_roundnetareavalue =  FLOOR(l_grossvalue / 100)*100;
						
                 
                            INSERT INTO temp_landstand
							(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`)
							VALUES
							(l_lotid, 0,l_stdesc,l_currarea);
                            
					set l_currseq = l_currseq + 1;
							
						
						
				END LOOP standardarea_loop;
				end BLOCK2;            
			
			end if;
       
	END LOOP get_lot;
 select * from temp_landstand;
 select sum(vla_area) from temp_landstand;
 drop table temp_landstand;
 CLOSE lot_cursor;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mass_bldg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mass_bldg`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
declare l_bldg_no varchar(15);
DECLARE l_subzone varchar(5);
declare l_bldgtype_id varchar(10) ;
declare l_bldgstorey_id varchar(10) ;
declare l_bldgcondn_id varchar(2) ;
declare l_bldgposition_id varchar(4) ;
declare l_bldgstructure_id varchar(2) ;
declare l_rooftype_id varchar(2) ;
declare l_walltype_id varchar(2) ;
declare l_floortype_id varchar(2) ;
declare l_bldgcategory_id varchar(2) ;
declare l_cccdate date ;
declare l_occupieddate date ;
declare l_ismainbldg_id varchar(1);
DECLARE l_vd_id INT;
DECLARE l_countallownace INT;
DECLARE l_bldgcount INT;
DECLARE l_bldgid INT;
DECLARE l_valbldgid INT;
DECLARE l_newbldgarid INT;
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_ref varchar(50);
DECLARE l_areatype_id varchar(5) ;
DECLARE l_arealevel_id varchar(3) ;
DECLARE l_areacategory_id varchar(5) ;
DECLARE l_areazone_id varchar(5) ;
DECLARE l_areause_id varchar(3) ;
DECLARE l_areadesc varchar(250) ;
DECLARE l_dimention varchar(150) ;
DECLARE l_unitcount smallint(6) ;
DECLARE l_size float ;
DECLARE l_sizeunit_id varchar(5) ;
DECLARE l_totsize float ;
DECLARE l_bldgtonevalue float ;
DECLARE l_bldgallowancetonevalue float ;
DECLARE l_arfloortype_id varchar(2);
DECLARE l_arwalltype_id varchar(2);
DECLARE l_ceilingtype_id varchar(2);
DECLARE l_bldgargrossvalue float ;
DECLARE l_totalbldgargrossvalue float ;
DECLARE l_bldgarnetvalue float ;
DECLARE l_grossallowance float ;
DECLARE l_grossnet float ;
DECLARE l_grossroundnet float ;
DECLARE l_depreciationrate float ;
DECLARE l_bldgdepreciationvalue float ;
DECLARE l_netnt float ;
DECLARE l_roundnetnt float ;
DECLARE l_depreciationvalue float ;
DECLARE l_flag varchar(5) ;
DECLARE bldgardone BOOLEAN DEFAULT FALSE; 
DECLARE l_valtype varchar(2);
DECLARE l_bldgstatus varchar(2);
DECLARE l_valstatus varchar(2);

DEClARE bldg_cursor CURSOR FOR 
select vd_id,ab_id,ma_subzone_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id, ab_bldgcondn_id, 
ab_bldgposition_id, 
ab_bldgstructure_id ,ab_rooftype_id ,ab_walltype_id, ab_floortype_id, ab_cccdate, ab_occupieddate, 
ab_ismainbldg_id , ap_bldgstatus_id
from cm_appln_valdetl inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id inner join cm_appln_bldg on ab_vd_id = vd_id
where  vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');

DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

select vt_valbase_id into l_valtype from cm_appln_valterm 
inner join cm_appln_val on va_vt_id = vt_id  where va_id = p_valuationbasket  limit 1;

OPEN bldg_cursor;
	get_bldg: LOOP
		IF v_finished = 1 THEN 
			LEAVE get_bldg;
		END IF;
		 FETCH bldg_cursor INTO l_vd_id, l_bldgid,l_subzone, l_bldg_no,  l_bldgtype_id,  l_bldgstorey_id, 
         l_bldgcondn_id, l_bldgposition_id, l_bldgstructure_id, l_rooftype_id, l_walltype_id, 
         l_floortype_id,	l_cccdate, l_occupieddate, l_ismainbldg_id, l_bldgstatus;
		 set l_totalbldgargrossvalue = 0;
        
         select tdi_parent_key into l_bldgcategory_id from tbdefitems where tdi_td_name = "BULDINGTYPE"
         and tdi_key = l_bldgtype_id ;
         
          select count(*) into l_bldgcount from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id;
              if l_bldgcount = 0 then 
                
				INSERT INTO `cm_appln_val_bldg`
				(`vb_vd_id`,`vb_bldg_no`,`vb_bldgtype_id`,`vb_bldgstorey_id`,`vb_bldgcondn_id`,`vb_bldgposition_id`,
				`vb_bldgstructure_id`,`vb_rooftype_id`,`vb_walltype_id`,`vb_floortype_id`,`vb_cccdate`,
				`vb_occupieddate`,`vb_ismainbldg_id`,
				`vb_createby`,`vb_createdate`,`vb_updateby`,`vb_updatedate`)
				VALUES(l_vd_id, l_bldg_no,l_bldgtype_id,l_bldgstorey_id,l_bldgcondn_id,l_bldgposition_id,l_bldgstructure_id,
				l_rooftype_id
				,l_walltype_id,l_floortype_id,l_cccdate,l_occupieddate,l_ismainbldg_id
				,p_username,	NOW(),p_username,NOW());
					SELECT LAST_INSERT_ID() into l_valbldgid;
			else
         
				select vb_id into l_valbldgid from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id ;
         
			end if;
		
        BLOCK2: begin
			
			DECLARE v_finished2 INTEGER DEFAULT 0;
			DEClARE bldgar_cursor CURSOR FOR 
			select aba_ref,aba_areatype_id,aba_arealevel_id,aba_areacategory_id,aba_areazone_id,aba_areause_id,aba_areadesc,
			aba_dimention,aba_unitcount,aba_size,aba_sizeunit_id,aba_totsize,aba_floortype_id,aba_walltype_id,aba_ceilingtype_id
			from cm_appln_bldg, cm_appln_bldgarea
			where aba_ab_id = ab_id and aba_ab_id = l_bldgid and ab_vd_id = l_vd_id;     
            
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished2 = 1;
            
            
            
			OPEN bldgar_cursor;
            bldgarea_loop: LOOP		
				
                FETCH bldgar_cursor INTO l_ref, l_areatype_id, l_arealevel_id,
                l_areacategory_id, l_areazone_id,  l_areause_id, l_areadesc, l_dimention,
                l_unitcount, l_size, l_sizeunit_id, l_totsize, l_arfloortype_id, l_arwalltype_id,
                l_ceilingtype_id;
             
         
                SELECT   tbldg_value into l_bldgtonevalue
				FROM cm_tone_building where  tbldg_subzon_id = l_subzone and      tbldg_proptype_id = l_bldgtype_id and
				tbldg_propstorey_id = l_bldgstorey_id and
				tbldg_areatype_id = l_areatype_id and  tbldg_arealevel_id = l_arealevel_id and  
				tbldg_areacategory_id = l_areacategory_id and  tbldg_areause_id = l_areause_id 
				and tbldg_transtype_id = 1
                and tbldg_tone_id = p_tonebasket ;
				 
                 
         
               
                if l_bldgtonevalue is not null then               
					set l_flag = 'Y';
                    select count(*) into l_newbldgarid from `cm_appln_val_bldgarea` where `vba_vb_id` = l_valbldgid and `vba_ref` = l_ref and
                    `vba_areatype_id` = l_areatype_id and `vba_arealevel_id` = l_arealevel_id and `vba_areacategory_id`= l_areacategory_id and 
                    `vba_areause_id`= l_areause_id and 
					`vba_areadesc`= l_areadesc and `vba_unitcount`= l_unitcount and `vba_size`= l_size and 
                    `vba_sizeunit_id`= l_sizeunit_id and `vba_totsize` = l_totsize;
                    
                    IF l_newbldgarid = 0 THEN
                    
						set l_bldgargrossvalue = l_totsize * l_bldgtonevalue;
						set l_bldgarnetvalue = l_bldgargrossvalue;
						set l_totalbldgargrossvalue = l_totalbldgargrossvalue + l_bldgargrossvalue;
						
						INSERT INTO `cm_appln_val_bldgarea`
						(`vba_vb_id`,`vba_ref`,`vba_areatype_id`,`vba_arealevel_id`,`vba_areacategory_id`,`vba_areause_id`,
						`vba_areadesc`,`vba_unitcount`,`vba_size`,`vba_sizeunit_id`,`vba_totsize`,`vba_bldgrate`,`vba_discountrate`,
						`vba_discountvalue`,`vba_grossareavalue`,`vba_netareavalue`,`vba_createby`,`vba_createdate`,`vba_updateby`,
						`vba_updatedate`)
						VALUES(l_valbldgid,l_ref, l_areatype_id, l_arealevel_id,
						l_areacategory_id,  l_areause_id, l_areadesc, 
						l_unitcount, l_size, l_sizeunit_id, l_totsize, l_bldgtonevalue, 0, 0,l_bldgargrossvalue,l_bldgarnetvalue
						,p_username,	NOW(),p_username,NOW());
                        
                    END IF;
                end if;
                IF v_finished2 = 1 THEN 
                   
					LEAVE bldgarea_loop;                    
				END IF;
			END LOOP bldgarea_loop;
            
			
               
                    SELECT 
				tallo_value into l_bldgallowancetonevalue
				FROM cm_tone_bldg_allowances where  tallo_allowancetype_id = l_bldgposition_id
				and  tallo_buldingcategory_id = l_bldgcategory_id and tallo_tone_id = p_tonebasket ;
                if l_bldgallowancetonevalue is null then
					set l_bldgallowancetonevalue =  0;
                end if;
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                 SELECT 
				count(*) into l_countallownace
				FROM cm_appln_val_bldgallowances where  vbal_vb_id = l_valbldgid
				and  vbal_allowancetype_id = l_bldgposition_id and vbal_calcmethod_id = '1'  and vbal_drivevalue = l_bldgallowancetonevalue 
                 and vbal_grossallowancevalue = l_grossallowance  and vbal_roundgrossallowancevalue = roundoff(l_grossallowance, 1) ;
                 if l_countallownace = 0 then
                 if l_bldgposition_id is not null and l_grossallowance <> 0 then
					 INSERT INTO `cm_appln_val_bldgallowances`
				(`vbal_vb_id`,`vbal_allowancetype_id`,`vbal_calcmethod_id`,`vbal_drivevalue`,`vbal_grossallowancevalue`,
				`vbal_roundgrossallowancevalue`,`vbal_createby`,`vbal_createdate`,`vbal_updateby`,`vbal_updatedate`)
				VALUES(l_valbldgid,l_bldgposition_id,'1',l_bldgallowancetonevalue, l_grossallowance,
                 roundoff(l_grossallowance, 1),p_username,	NOW(),p_username,NOW() );
                    end if;
               end if;
					
                    SELECT `tdepre_value` into l_depreciationvalue
					FROM `cm_tone_bldg_depreciation` where tdepre_bldgcondn_id = l_bldgcondn_id 
                    and tdepre_tone_id = p_tonebasket limit 1;
                    
                    set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =  roundoff(l_netnt, 1);
						
					update `cm_appln_val_bldg` set
					`vb_grossfloorvalue` = l_totalbldgargrossvalue,
					`vb_grossallowancevalue` = l_grossallowance,`vb_grossnt` =l_grossnet,
					`vb_depreciationrate`= l_depreciationvalue,`vb_depreciationvalue` =l_bldgdepreciationvalue,
					`vb_netnt` =l_netnt,`vb_roundnetnt` = l_roundnetnt where vb_id = l_valbldgid;
			
                        
	
          CLOSE bldgar_cursor;
		end BLOCK2; 
        
      
        
    
	END LOOP get_bldg;
    
 CLOSE bldg_cursor;

 SELECT count(*) into l_bldgcount  FROM cama.cm_appln_val_bldg where vb_netnt = 0;
 SELECT vb_id, vb_depreciationvalue into l_bldgid, l_depreciationvalue  FROM cm_appln_val_bldg
 inner join cm_appln_valdetl on vd_id = vb_vd_id where vb_netnt = 0  and vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07') limit 1;
 SELECT sum(vba_grossareavalue) into l_totalbldgargrossvalue from cm_appln_val_bldgarea
 where vba_vb_id = l_bldgid ;
 SELECT vbal_drivevalue, vbal_id into l_bldgallowancetonevalue,l_vd_id from cm_appln_val_bldgallowances
 where vbal_grossallowancevalue = 0 and vbal_vb_id = l_bldgid limit 1;
 if l_bldgcount > 0 then
 
		
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                
                UPDATE `cm_appln_val_bldgallowances` SET `vbal_grossallowancevalue` = l_grossallowance,
				`vbal_roundgrossallowancevalue` = roundoff(l_grossallowance, 1)
                WHERE vbal_id = l_vd_id;
                SELECT `tdepre_value` into l_depreciationvalue
					FROM `cm_tone_bldg_depreciation` where tdepre_bldgcondn_id = l_bldgcondn_id 
                    and tdepre_tone_id = p_tonebasket limit 1;
                    
                 set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =  roundoff(l_netnt, 1);
						
					update `cm_appln_val_bldg` set
					`vb_grossfloorvalue` = l_totalbldgargrossvalue,
					`vb_grossallowancevalue` = l_grossallowance,`vb_grossnt` =l_grossnet,
					`vb_depreciationrate`= l_depreciationvalue,`vb_depreciationvalue` =l_bldgdepreciationvalue,
					`vb_netnt` =l_netnt,`vb_roundnetnt` = l_roundnetnt where vb_id = l_bldgid; 
 end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mass_bldg2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mass_bldg2`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
declare l_bldg_no varchar(15);
DECLARE l_subzone varchar(5);
declare l_bldgtype_id varchar(10) ;
declare l_bldgstorey_id varchar(10) ;
declare l_bldgcondn_id varchar(2) ;
declare l_bldgposition_id varchar(4) ;
declare l_bldgstructure_id varchar(2) ;
declare l_rooftype_id varchar(2) ;
declare l_walltype_id varchar(2) ;
declare l_floortype_id varchar(2) ;
declare l_bldgcategory_id varchar(2) ;
declare l_cccdate date ;
declare l_occupieddate date ;
declare l_ismainbldg_id varchar(1);
DECLARE l_vd_id INT;
DECLARE l_bldgcount INT;
DECLARE l_countallownace INT;
DECLARE l_bldgid INT;
DECLARE l_valbldgid INT;
DECLARE l_newbldgarid INT;
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_ref varchar(50);
DECLARE l_areatype_id varchar(5) ;
DECLARE l_arealevel_id varchar(3) ;
DECLARE l_areacategory_id varchar(5) ;
DECLARE l_areazone_id varchar(5) ;
DECLARE l_areause_id varchar(3) ;
DECLARE l_areadesc varchar(250) ;
DECLARE l_dimention varchar(150) ;
DECLARE l_unitcount smallint(6) ;
DECLARE l_size float ;
DECLARE l_sizeunit_id varchar(5) ;
DECLARE l_totsize float ;
DECLARE l_bldgtonevalue float ;
DECLARE l_bldgallowancetonevalue float ;
DECLARE l_arfloortype_id varchar(2);
DECLARE l_arwalltype_id varchar(2);
DECLARE l_ceilingtype_id varchar(2);
DECLARE l_bldgargrossvalue float ;
DECLARE l_totalbldgargrossvalue float ;
DECLARE l_bldgarnetvalue float ;
DECLARE l_grossallowance float ;
DECLARE l_grossnet float ;
DECLARE l_grossroundnet float ;
DECLARE l_depreciationrate float ;
DECLARE l_bldgdepreciationvalue float ;
DECLARE l_netnt float ;
DECLARE l_roundnetnt float ;
DECLARE l_depreciationvalue float ;
DECLARE l_flag varchar(5) ;
DECLARE bldgardone BOOLEAN DEFAULT FALSE; 
DECLARE l_valtype varchar(2);
DECLARE l_bldgstatus varchar(2);
DECLARE l_valstatus varchar(2);

DEClARE bldg_cursor CURSOR FOR 
select vd_id,ab_id,ma_subzone_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id, ab_bldgcondn_id, 
ab_bldgposition_id, 
ab_bldgstructure_id ,ab_rooftype_id ,ab_walltype_id, ab_floortype_id, ab_cccdate, ab_occupieddate, 
ab_ismainbldg_id , ap_bldgstatus_id
from cm_appln_valdetl inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id inner join cm_appln_bldg on ab_vd_id = vd_id
where  vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07') and ap_bldgstatus_id = 1;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

select vt_valbase_id into l_valtype from cm_appln_valterm 
inner join cm_appln_val on va_vt_id = vt_id  where va_id = p_valuationbasket  limit 1;

OPEN bldg_cursor;
	get_bldg: LOOP
		IF v_finished = 1 THEN 
			LEAVE get_bldg;
		END IF;
		 FETCH bldg_cursor INTO l_vd_id, l_bldgid,l_subzone, l_bldg_no,  l_bldgtype_id,  l_bldgstorey_id, 
         l_bldgcondn_id, l_bldgposition_id, l_bldgstructure_id, l_rooftype_id, l_walltype_id, 
         l_floortype_id,	l_cccdate, l_occupieddate, l_ismainbldg_id, l_bldgstatus;
		 set l_totalbldgargrossvalue = 0;
        
         select tdi_parent_key into l_bldgcategory_id from tbdefitems where tdi_td_name = "BULDINGTYPE"
         and tdi_key = l_bldgtype_id ;
         
          select count(*) into l_bldgcount from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id;
              if l_bldgcount = 0 then 
                
				INSERT INTO `cm_appln_val_bldg`
				(`vb_vd_id`,`vb_bldg_no`,`vb_bldgtype_id`,`vb_bldgstorey_id`,`vb_bldgcondn_id`,`vb_bldgposition_id`,
				`vb_bldgstructure_id`,`vb_rooftype_id`,`vb_walltype_id`,`vb_floortype_id`,`vb_cccdate`,
				`vb_occupieddate`,`vb_ismainbldg_id`,
				`vb_createby`,`vb_createdate`,`vb_updateby`,`vb_updatedate`)
				VALUES(l_vd_id, l_bldg_no,l_bldgtype_id,l_bldgstorey_id,l_bldgcondn_id,l_bldgposition_id,l_bldgstructure_id,
				l_rooftype_id
				,l_walltype_id,l_floortype_id,l_cccdate,l_occupieddate,l_ismainbldg_id
				,p_username,	NOW(),p_username,NOW());
					SELECT LAST_INSERT_ID() into l_valbldgid;
			else
         
				select vb_id into l_valbldgid from cm_appln_val_bldg where vb_bldg_no = l_bldg_no and vb_vd_id = l_vd_id ;
         
			end if;
		
        BLOCK2: begin
        
			DECLARE v_finished2 INTEGER DEFAULT 0;
			DEClARE bldgar_cursor CURSOR FOR 
			select aba_ref,aba_areatype_id,aba_arealevel_id,aba_areacategory_id,aba_areazone_id,aba_areause_id,aba_areadesc,
			aba_dimention,aba_unitcount,aba_size,aba_sizeunit_id,aba_totsize,aba_floortype_id,aba_walltype_id,aba_ceilingtype_id
			from cm_appln_bldg, cm_appln_bldgarea
			where aba_ab_id = ab_id and aba_ab_id = l_bldgid and ab_vd_id = l_vd_id; 
            
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished2 = 1;
            
         
            
			OPEN bldgar_cursor;
            bldgarea_loop: LOOP		
					
                FETCH bldgar_cursor INTO l_ref, l_areatype_id, l_arealevel_id,
                l_areacategory_id, l_areazone_id,  l_areause_id, l_areadesc, l_dimention,
                l_unitcount, l_size, l_sizeunit_id, l_totsize, l_arfloortype_id, l_arwalltype_id,
                l_ceilingtype_id;
         
                SELECT   tbldg_value into l_bldgtonevalue
				FROM cm_tone_building where  tbldg_subzon_id = l_subzone and     tbldg_proptype_id = l_bldgtype_id and
				tbldg_propstorey_id = l_bldgstorey_id and
				tbldg_areatype_id = l_areatype_id and  tbldg_arealevel_id = l_arealevel_id and  
				tbldg_areacategory_id = l_areacategory_id and  tbldg_areause_id = l_areause_id 
				and tbldg_transtype_id = 2
                and tbldg_tone_id = p_tonebasket ;
				
         
               
                if l_bldgtonevalue is not null then               
					set l_flag = 'Y';
                    select count(*) into l_newbldgarid from `cm_appln_val_bldgarea` where `vba_vb_id` = l_valbldgid and `vba_ref` = l_ref and
                    `vba_areatype_id` = l_areatype_id and `vba_arealevel_id` = l_arealevel_id and `vba_areacategory_id`= l_areacategory_id and 
                    `vba_areause_id`= l_areause_id and 
					`vba_areadesc`= l_areadesc and `vba_unitcount`= l_unitcount and `vba_size`= l_size and 
                    `vba_sizeunit_id`= l_sizeunit_id and `vba_totsize` = l_totsize;
                    
                    IF l_newbldgarid = 0 THEN
                    
						set l_bldgargrossvalue = l_totsize * l_bldgtonevalue;
						set l_bldgarnetvalue = l_bldgargrossvalue;
						set l_totalbldgargrossvalue = l_totalbldgargrossvalue + l_bldgargrossvalue;
						
                        
						INSERT INTO `cm_appln_val_bldgarea`
						(`vba_vb_id`,`vba_ref`,`vba_areatype_id`,`vba_arealevel_id`,`vba_areacategory_id`,`vba_areause_id`,
						`vba_areadesc`,`vba_unitcount`,`vba_size`,`vba_sizeunit_id`,`vba_totsize`,`vba_bldgrate`,`vba_discountrate`,
						`vba_discountvalue`,`vba_grossareavalue`,`vba_netareavalue`,`vba_createby`,`vba_createdate`,`vba_updateby`,
						`vba_updatedate`)
						VALUES(l_valbldgid,l_ref, l_areatype_id, l_arealevel_id,
						l_areacategory_id,  l_areause_id, l_areadesc, 
						l_unitcount, l_size, l_sizeunit_id, l_totsize, l_bldgtonevalue, 0, 0,l_bldgargrossvalue,l_bldgarnetvalue
						,p_username,	NOW(),p_username,NOW());
                    END IF;
                end if;
                IF v_finished2 = 1 THEN 
                  
					LEAVE bldgarea_loop;                    
				END IF;
			END LOOP bldgarea_loop;
            
			
               
                    SELECT 
				tallo_value into l_bldgallowancetonevalue
				FROM cm_tone_bldg_allowances where  tallo_allowancetype_id = l_bldgposition_id
				and  tallo_buldingcategory_id = l_bldgcategory_id and tallo_tone_id = p_tonebasket ;
                if l_bldgallowancetonevalue is null then
					set l_bldgallowancetonevalue =  0;
                end if;
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                 SELECT 
				count(*) into l_countallownace
				FROM cm_appln_val_bldgallowances where  vbal_vb_id = l_valbldgid
				and  vbal_allowancetype_id = l_bldgposition_id and vbal_calcmethod_id = '1'  and vbal_drivevalue = l_bldgallowancetonevalue 
                 and vbal_grossallowancevalue = l_grossallowance  and vbal_roundgrossallowancevalue = roundoff(l_grossallowance, 1) ;
                if l_countallownace = 0 then
                 if l_bldgposition_id is not null and l_bldgallowancetonevalue <> 0 then
					 INSERT INTO `cm_appln_val_bldgallowances`
				(`vbal_vb_id`,`vbal_allowancetype_id`,`vbal_calcmethod_id`,`vbal_drivevalue`,`vbal_grossallowancevalue`,
				`vbal_roundgrossallowancevalue`,`vbal_createby`,`vbal_createdate`,`vbal_updateby`,`vbal_updatedate`)
				VALUES(l_valbldgid,l_bldgposition_id,'1',l_bldgallowancetonevalue, l_grossallowance,
                 roundoff(l_grossallowance, 1),p_username,	NOW(),p_username,NOW() );
                    end if;
               
					end if;
                    
                    SELECT `tdepre_value` into l_depreciationvalue
					FROM `cm_tone_bldg_depreciation` where tdepre_bldgcondn_id = l_bldgcondn_id 
                    and tdepre_tone_id = p_tonebasket limit 1;
                    
                    set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =  roundoff(l_netnt, 1);
						
					update `cm_appln_val_bldg` set
					`vb_grossfloorvalue` = l_totalbldgargrossvalue,
					`vb_grossallowancevalue` = l_grossallowance,`vb_grossnt` =l_grossnet,
					`vb_depreciationrate`= l_depreciationvalue,`vb_depreciationvalue` =l_bldgdepreciationvalue,
					`vb_netnt` =l_netnt,`vb_roundnetnt` = l_roundnetnt where vb_id = l_valbldgid;
			
                        
	
          CLOSE bldgar_cursor;
		end BLOCK2; 
        
        
        
    
	END LOOP get_bldg;
    
 CLOSE bldg_cursor;

 SELECT count(*) into l_bldgcount  FROM cama.cm_appln_val_bldg where vb_netnt = 0;
 SELECT vb_id, vb_depreciationvalue into l_bldgid, l_depreciationvalue  FROM cm_appln_val_bldg
 inner join cm_appln_valdetl on vd_id = vb_vd_id where vb_netnt = 0  and vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07') limit 1;
 SELECT sum(vba_grossareavalue) into l_totalbldgargrossvalue from cm_appln_val_bldgarea
 where vba_vb_id = l_bldgid ;
 SELECT vbal_drivevalue, vbal_id into l_bldgallowancetonevalue,l_vd_id from cm_appln_val_bldgallowances
 where vbal_grossallowancevalue = 0 and vbal_vb_id = l_bldgid limit 1;
 if l_bldgcount > 0 then
 
		
                
                set l_grossallowance = l_totalbldgargrossvalue * ( l_bldgallowancetonevalue / 100 );
                
                UPDATE `cm_appln_val_bldgallowances` SET `vbal_grossallowancevalue` = l_grossallowance,
				`vbal_roundgrossallowancevalue` = roundoff(l_grossallowance, 1)
                WHERE vbal_id = l_vd_id;
                
                 set l_grossnet = l_totalbldgargrossvalue + l_grossallowance;
                    set l_bldgdepreciationvalue = l_grossnet * (l_depreciationvalue / 100);
                    set l_netnt = l_grossnet - l_bldgdepreciationvalue;
                    set l_roundnetnt =  roundoff(l_netnt, 1);
						
					update `cm_appln_val_bldg` set
					`vb_grossfloorvalue` = l_totalbldgargrossvalue,
					`vb_grossallowancevalue` = l_grossallowance,`vb_grossnt` =l_grossnet,
					`vb_depreciationrate`= l_depreciationvalue,`vb_depreciationvalue` =l_bldgdepreciationvalue,
					`vb_netnt` =l_netnt,`vb_roundnetnt` = l_roundnetnt where vb_id = l_bldgid; 
 end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mass_lot` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mass_lot`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_vd_id int;
DECLARE l_subzone varchar(5);
DECLARE l_bldgtype varchar(5);
DECLARE l_proptype varchar(5);
DECLARE l_propcategory varchar(5);
DECLARE l_propertylevel varchar(5);
DECLARE l_state varchar(2);
DECLARE l_mbp varchar(20);
DECLARE l_ptss varchar(3);
DECLARE l_lotcode_id varchar(2);
DECLARE l_no varchar(15);
DECLARE l_altno varchar(15);
DECLARE l_titletype_id varchar(3);
DECLARE l_titleno varchar(8);
DECLARE l_alttitleno varchar(8);
DECLARE l_size float(15,4);
DECLARE l_sizeunit_id varchar(2);
DECLARE l_landcondition_id varchar(4);
DECLARE l_landposision_id varchar(4);
DECLARE l_roadtype_id varchar(3);
DECLARE l_roadcategory_id varchar(3);
DECLARE l_landuse_id varchar(4);
DECLARE l_excd text;
DECLARE l_rtit text;
DECLARE l_tenuretype_id varchar(3);
DECLARE l_tenureperiod int(3);
DECLARE l_startdate date;
DECLARE l_expireddate date;
DECLARE l_activeind_id varchar(4); 
DECLARE landrate float;
DECLARE l_standardarea float;
DECLARE l_nextarea float;
DECLARE l_maxlevel float;
DECLARE l_grossvalue float;
DECLARE l_roundnetareavalue float;
DECLARE l_totalgrossarea float;
DECLARE l_totalgrossvalue float default 0;
DECLARE l_totalroundnetarea float;
DECLARE l_discount float default 20;
declare l_count int default 1;
declare l_lotid int default 0;
declare tonecount int default 0;
DECLARE llanarea float default 0;
DECLARE copylanarea float;
DECLARE l_discounttmp INT;
DECLARE l_islast INT default 0;
DECLARE l_valtype varchar(2);
DECLARE l_bldgstatus varchar(2);
DECLARE l_valstatus varchar(2);


DECLARE i int;
 
	DEClARE lot_cursor CURSOR FOR 
		select vd_id,ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id, al_state, al_lotcode_id, al_no, al_altno, al_titletype_id,
		al_titleno, al_alttitleno, al_size, al_sizeunit_id, al_landcondition_id, al_landposision_id, al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id, al_tenureperiod,
		al_startdate, al_expireddate, al_activeind_id from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id
        inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id
		where vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');
    
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
    
select vt_valbase_id into l_valtype from cm_appln_valterm 
inner join cm_appln_val on va_vt_id = vt_id  where va_id = p_valuationbasket limit 1;

    
    
    OPEN lot_cursor;
    
    
	get_lot: LOOP
		
		FETCH lot_cursor INTO l_vd_id, l_subzone, l_bldgtype,  l_propcategory, l_proptype, l_propertylevel, l_state, l_lotcode_id, l_no, l_altno, l_titletype_id, l_titleno,
		l_alttitleno, l_size, l_sizeunit_id, l_landcondition_id, l_landposision_id,	l_roadtype_id, l_roadcategory_id, l_landuse_id, l_excd, l_rtit,
		l_tenuretype_id, l_tenureperiod, l_startdate, l_expireddate, l_activeind_id;
       
		set copylanarea = l_size;
        
		IF v_finished = 1 THEN 
			LEAVE get_lot;
		END IF;
         
		select tland_value into landrate from cm_tone_land where tland_ishasbuilding_id = l_bldgtype and tland_subzon_id = l_subzone 
        and  tland_proptype_id = l_proptype and tland_propstorey_id = l_propertylevel and tland_tone_id = p_tonebasket;

		select tstand_standartarea, tstand_nextarea, tstand_maxlevel into l_standardarea, l_nextarea, l_maxlevel from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
		select count(*) into tonecount from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
        
        set llanarea = l_size;
        set l_discount = 100;
        set l_discounttmp = 100;
        
        if (tonecount > 0) then
			SET l_count = 1;
			INSERT INTO `cm_appln_val_lot`(`vl_vd_id` ,`vl_lotcode_id`,`vl_no`,
			`vl_altno`,`vl_titletype_id`, `vl_titleno`,	`vl_alttitleno`,`vl_size`,`vl_sizeunit_id`,
			`vl_standardarea`,`vl_nextarea`,`vl_maxlevel`,`vl_landcondition_id`,`vl_landposision_id`,
			`vl_roadtype_id`,`vl_roadcategory_id`,`vl_landuse_id`,	`vl_tenuretype_id`,`vl_tenureperiod`,`vl_startdate`,
			`vl_expireddate`,`vl_createby`,	`vl_createdate`,`vl_updateby`,`vl_updatedate`) 
            VALUES (l_vd_id ,l_lotcode_id,l_no,	l_altno, l_titletype_id, l_titleno,	l_alttitleno,
            copylanarea,l_sizeunit_id,	l_standardarea,l_nextarea,l_maxlevel,
			l_landcondition_id,l_landposision_id,	l_roadtype_id,l_roadcategory_id,l_landuse_id,
			l_tenuretype_id,l_tenureperiod, l_startdate,l_expireddate,p_username,	NOW(),p_username,NOW());
			SELECT LAST_INSERT_ID() into l_lotid;
            
			
            
				BLOCK2: begin
				declare l_currseq int default 0;
                declare l_stdesc varchar(255);
                declare l_initdiscount int default 10;
                declare l_currdiscount int default 0;
                declare l_balancearea float default 0;
                declare l_currarea float default 0;
                declare dummy float;
                
                set l_balancearea = l_size;
                set l_currarea = l_balancearea;
                set l_grossvalue = 0;
                set l_totalgrossvalue = 0;


		standardarea_loop: LOOP		

						
						if l_currseq < l_maxlevel and l_balancearea > 0 then
							set dummy = 0;
                        else
                        
							LEAVE standardarea_loop;
                        end if;
                        
                        if l_currseq = 0 then
							set l_stdesc = 'Main Area';
                            set l_currdiscount = 0;
                        else
							set l_stdesc = concat('Additional Area ' ,l_currseq);
                            set l_currdiscount = l_initdiscount + (l_currseq * 10);
                        end if;
                     
                        
                        if l_currseq = 0 then
							if l_standardarea <> 0 then
								If l_balancearea < l_standardarea then
									set l_currarea = l_balancearea;
									set l_balancearea = 0;
                                else
									set l_currarea = l_standardarea;
									set l_balancearea = l_balancearea - l_currarea;
                                end if;
                            else
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            end if;
						elseif l_currseq > 0 And l_currseq <= l_maxlevel - 1 then
							If l_balancearea < l_nextarea then
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            else
								set l_currarea = l_nextarea;
								set l_balancearea = l_balancearea - l_nextarea;
                            end if;
                        elseif  l_currseq = l_maxlevel then
							set l_currarea = l_balancearea;
							set l_balancearea = 0;
                        end if;
						
                        set l_grossvalue = l_currarea * landrate * ( 100 - l_currdiscount)/100;
						set l_roundnetareavalue =  roundoff(l_grossvalue, 1);
						set l_totalgrossvalue = l_totalgrossvalue + l_grossvalue;
                            INSERT INTO `cm_appln_val_lotarea`
				(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,`vla_landrate`,
				`vla_discountrate`,`vla_grossareavalue`,`vla_roundnetareavalue`,
				`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
				VALUES
				(l_lotid, l_currseq,l_stdesc,l_currarea,landrate,l_currdiscount, l_grossvalue,l_roundnetareavalue,
				p_username, now(), p_username, now() );
                            
                            
					set l_currseq = l_currseq + 1;
							
						
						
				END LOOP standardarea_loop;
				end BLOCK2;            
			
            UPDATE cm_appln_val_lot SET vl_grosslandvalue = l_totalgrossvalue,
    vl_roundnetlandvalue = roundoff(l_totalgrossvalue,1)
    WHERE vl_id = l_lotid;
            
		end if;
       
	END LOOP get_lot;
 
 CLOSE lot_cursor;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mass_lot2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mass_lot2`(p_valuationbasket int, p_tonebasket int, p_username varchar(255))
BEGIN
DECLARE v_finished INTEGER DEFAULT 0;
DECLARE l_vd_id int;
DECLARE l_subzone varchar(5);
DECLARE l_bldgtype varchar(5);
DECLARE l_proptype varchar(5);
DECLARE l_propcategory varchar(5);
DECLARE l_propertylevel varchar(5);
DECLARE l_state varchar(2);
DECLARE l_mbp varchar(20);
DECLARE l_ptss varchar(3);
DECLARE l_lotcode_id varchar(2);
DECLARE l_no varchar(15);
DECLARE l_altno varchar(15);
DECLARE l_titletype_id varchar(3);
DECLARE l_titleno varchar(8);
DECLARE l_alttitleno varchar(8);
DECLARE l_size float(15,4);
DECLARE l_sizeunit_id varchar(2);
DECLARE l_landcondition_id varchar(4);
DECLARE l_landposision_id varchar(4);
DECLARE l_roadtype_id varchar(3);
DECLARE l_roadcategory_id varchar(3);
DECLARE l_landuse_id varchar(4);
DECLARE l_excd text;
DECLARE l_rtit text;
DECLARE l_tenuretype_id varchar(3);
DECLARE l_tenureperiod int(3);
DECLARE l_startdate date;
DECLARE l_expireddate date;
DECLARE l_activeind_id varchar(4); 
DECLARE landrate float;
DECLARE l_standardarea float;
DECLARE l_nextarea float;
DECLARE l_maxlevel float;
DECLARE l_grossvalue float;
DECLARE l_roundnetareavalue float;
DECLARE l_totalgrossarea float;
DECLARE l_totalroundnetarea float;
DECLARE l_discount float default 20;
declare l_count int default 1;
declare l_lotid int default 0;
declare tonecount int default 0;
DECLARE llanarea float default 0;
DECLARE copylanarea float;
DECLARE l_discounttmp INT;
DECLARE l_islast INT default 0;
DECLARE l_valtype varchar(2);
DECLARE l_bldgstatus varchar(2);
DECLARE l_totalgrossvalue float default 0;
DECLARE l_valstatus varchar(2);


DECLARE i int;
 
	DEClARE lot_cursor CURSOR FOR 
		select vd_id,ma_subzone_id, ap_bldgstatus_id, ap_propertycategory_id, ap_propertytype_id, ap_propertylevel_id, al_state, al_lotcode_id, al_no, al_altno, al_titletype_id,
		al_titleno, al_alttitleno, al_size, al_sizeunit_id, al_landcondition_id, al_landposision_id, al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id, al_tenureperiod,
		al_startdate, al_expireddate, al_activeind_id from cm_appln_valdetl inner join cm_appln_lot on al_vd_id = vd_id
        inner join cm_appln_parameter on ap_vd_id  = vd_id inner join cm_masterlist on ma_id = vd_ma_id
		where vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07') and ap_bldgstatus_id = 0;
    
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
    
select vt_valbase_id into l_valtype from cm_appln_valterm 
inner join cm_appln_val on va_vt_id = vt_id  where va_id = p_valuationbasket limit 1;

    
    
    OPEN lot_cursor;
    
    
	get_lot: LOOP
		
		FETCH lot_cursor INTO l_vd_id, l_subzone, l_bldgtype,  l_propcategory, l_proptype, l_propertylevel, l_state, l_lotcode_id, l_no, l_altno, l_titletype_id, l_titleno,
		l_alttitleno, l_size, l_sizeunit_id, l_landcondition_id, l_landposision_id,	l_roadtype_id, l_roadcategory_id, l_landuse_id, l_excd, l_rtit,
		l_tenuretype_id, l_tenureperiod, l_startdate, l_expireddate, l_activeind_id;
        
		set copylanarea = l_size;
        
		IF v_finished = 1 THEN 
			LEAVE get_lot;
		END IF;
         
		select tland_value into landrate from cm_tone_land where tland_ishasbuilding_id = l_bldgtype and tland_subzon_id = l_subzone 
        and  tland_proptype_id = l_proptype and tland_propstorey_id = l_propertylevel and tland_tone_id = p_tonebasket;

		select tstand_standartarea, tstand_nextarea, tstand_maxlevel into l_standardarea, l_nextarea, l_maxlevel from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
		select count(*) into tonecount from cm_tone_land_standart 
		where tstand_subzon_id = l_subzone and tstand_proptype_id = l_proptype 
        and tstand_propstorey_id = l_propertylevel and tstand_tone_id = p_tonebasket;
		
        
        set llanarea = l_size;
        set l_discount = 100;
        set l_discounttmp = 100;
        
        if (tonecount > 0) then
			SET l_count = 1;
			INSERT INTO `cm_appln_val_lot`(`vl_vd_id` ,`vl_lotcode_id`,`vl_no`,
			`vl_altno`,`vl_titletype_id`, `vl_titleno`,	`vl_alttitleno`,`vl_size`,`vl_sizeunit_id`,
			`vl_standardarea`,`vl_nextarea`,`vl_maxlevel`,`vl_landcondition_id`,`vl_landposision_id`,
			`vl_roadtype_id`,`vl_roadcategory_id`,`vl_landuse_id`,	`vl_tenuretype_id`,`vl_tenureperiod`,`vl_startdate`,
			`vl_expireddate`,`vl_createby`,	`vl_createdate`,`vl_updateby`,`vl_updatedate`) 
            VALUES (l_vd_id ,l_lotcode_id,l_no,	l_altno, l_titletype_id, l_titleno,	l_alttitleno,
            copylanarea,l_sizeunit_id,	l_standardarea,l_nextarea,l_maxlevel,
			l_landcondition_id,l_landposision_id,	l_roadtype_id,l_roadcategory_id,l_landuse_id,
			l_tenuretype_id,l_tenureperiod, l_startdate,l_expireddate,p_username,	NOW(),p_username,NOW());
			SELECT LAST_INSERT_ID() into l_lotid;
            
			
			  
				BLOCK2: begin
				declare l_currseq int default 0;
                declare l_stdesc varchar(255);
                declare l_initdiscount int default 10;
                declare l_currdiscount int default 0;
                declare l_balancearea float default 0;
                declare l_currarea float default 0;
                declare dummy float;
                
                set l_balancearea = l_size;
                set l_currarea = l_balancearea;
                set l_grossvalue = 0;
                set l_totalgrossvalue = 0;


		standardarea_loop: LOOP		

						
						if l_currseq < l_maxlevel and l_balancearea > 0 then
							set dummy = 0;
                        else
                        
							LEAVE standardarea_loop;
                        end if;
                        
                        if l_currseq = 0 then
							set l_stdesc = 'Main Area';
                            set l_currdiscount = 0;
                        else
							set l_stdesc = concat('Additional Area ' ,l_currseq);
                            set l_currdiscount = l_initdiscount + (l_currseq * 10);
                        end if;
                     
                        
                        if l_currseq = 0 then
							if l_standardarea <> 0 then
								If l_balancearea < l_standardarea then
									set l_currarea = l_balancearea;
									set l_balancearea = 0;
                                else
									set l_currarea = l_standardarea;
									set l_balancearea = l_balancearea - l_currarea;
                                end if;
                            else
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            end if;
						elseif l_currseq > 0 And l_currseq <= l_maxlevel - 1 then
							If l_balancearea < l_nextarea then
								set l_currarea = l_balancearea;
								set l_balancearea = 0;
                            else
								set l_currarea = l_nextarea;
								set l_balancearea = l_balancearea - l_nextarea;
                            end if;
                        elseif  l_currseq = l_maxlevel then
							set l_currarea = l_balancearea;
							set l_balancearea = 0;
                        end if;
						
                        set l_grossvalue = l_currarea * landrate * ( 100 - l_currdiscount)/100;
						set l_roundnetareavalue =  roundoff(l_grossvalue, 1);
							set l_totalgrossvalue = l_totalgrossvalue + l_grossvalue;
                            INSERT INTO `cm_appln_val_lotarea`
				(`vla_vt_id`,`vla_sequent`,`vla_desc`,`vla_area`,`vla_landrate`,
				`vla_discountrate`,`vla_grossareavalue`,`vla_roundnetareavalue`,
				`vla_createby`,`vla_createdate`,`vla_updateby`,`vla_updatedate`)
				VALUES
				(l_lotid, 0,l_stdesc,l_currarea,landrate,l_currdiscount, l_grossvalue,l_roundnetareavalue,
				p_username, now(), p_username, now() );
                            
                            
					set l_currseq = l_currseq + 1;
							
						
						
				END LOOP standardarea_loop;
				end BLOCK2;            
			
            UPDATE cm_appln_val_lot SET vl_grosslandvalue = l_totalgrossvalue,
    vl_roundnetlandvalue = roundoff(l_totalgrossvalue,1)
    WHERE vl_id = l_lotid;
            
		end if;
      
	END LOOP get_lot;
 
 CLOSE lot_cursor;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mass_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mass_tax`(p_valuationbasket int, p_tonebasket int,drivedrate float,drivedvalue float, p_username varchar(255))
BEGIN
	DECLARE l_grossvalue float;
	DECLARE l_valuedescretion float;
	DECLARE l_proposednt float; 
	DECLARE l_proposedrate float; 
	DECLARE l_calculatedrate float; 
	DECLARE l_proposedtax float; 
	DECLARE l_approvednt float; 
	DECLARE l_approvedrate float; 
	DECLARE l_adjustment float; 
	DECLARE l_approvedtax float; 
	DECLARE l_note text;
    DECLARE v_finished int default 0;
    DECLARE l_taxrate float;
    DECLARE l_landvalue float;
    DECLARE l_bldgvalue float;
    DECLARE l_additionalvalue float;
    DECLARE l_propid int;
    DECLARE l_zone varchar(10);
    DECLARE l_bldgstatus varchar(10);
    DECLARE l_proptype varchar(10);
    DECLARE l_termtype varchar(10);
    
    
	DECLARE property_cursor CURSOR FOR 
	select vd_id, tdi_parent_key, ap_bldgstatus_id, ap_propertytype_id from cm_appln_valdetl, cm_appln_parameter, cm_masterlist
	left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") zone
	on zone.tdi_key = ma_subzone_id
	where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');
	
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
		
	OPEN property_cursor;
	
    get_data: LOOP
		
        FETCH property_cursor INTO l_propid, l_zone, l_bldgstatus, l_proptype;
		IF v_finished = 1 THEN 
			LEAVE get_data;
		END IF;
        
        select trate_value into l_taxrate from cm_tone_taxrate where trate_zon_id = l_zone and 
		trate_ishasbuilding_id = l_bldgstatus and trate_proptype_id = l_proptype and trate_trlist_id = p_tonebasket limit 1;
        
        select ifnull(sum(vl_roundnetlandvalue),0) into l_landvalue from cm_appln_val_lot where vl_vd_id = l_propid;
       
        select ifnull(sum(vb_roundnetnt),0) into l_bldgvalue from cm_appln_val_bldg where vb_vd_id = l_propid;
        
        select ifnull(sum(vad_roundnetvalue),0) into l_additionalvalue from cm_appln_val_additional where vad_vd_id = l_propid;
        set l_grossvalue = 0;
        set l_proposednt = 0;
        set l_proposedtax = 0;
        if l_taxrate is not null then
			set l_valuedescretion = 0;
           
            
           
           
          select vt_valbase_id into l_termtype from cm_appln_valterm 
		inner join cm_appln_val on va_vt_id = vt_id
		inner join cm_appln_valdetl on  vd_va_id = va_id where vd_id = l_propid; 
		
            set l_grossvalue = l_landvalue + l_bldgvalue  +  l_additionalvalue + l_valuedescretion;
				
        
           
           set l_proposednt = roundoff(l_grossvalue, 1);
           
            
            
            set l_calculatedrate = 100;
            set l_adjustment = 0;
            set l_proposedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100);
            set l_approvedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100) + l_adjustment;
             
            if drivedrate  is null then
				set drivedrate = 0;
            end if;
          
            INSERT INTO `cm_appln_val_tax`
			(`vt_vd_id`,`vt_grossvalue`,`vt_valuedescretion`,`vt_proposednt`,`vt_proposedrate`,`vt_calculatedrate`,
			`vt_proposedtax`,`vt_approvednt`,`vt_approvedrate`,`vt_adjustment`,`vt_approvedtax`,`vt_note`,`vt_createby`,
			`vt_createdate`,`vt_updateby`,`vt_updatedate`,`vt_derivedrate`,`vt_derivedvalue`)
			VALUES(l_propid,l_grossvalue, l_valuedescretion, l_proposednt,l_taxrate,l_calculatedrate,l_proposedtax,
            l_proposednt, l_taxrate,l_adjustment,l_approvedtax,'auto valuation',p_username, now(),p_username, now(),drivedrate, l_grossvalue);
            
            update cm_appln_valdetl set vd_approvalstatus_id = '08' where vd_id = l_propid;
        end if;
        
    END LOOP get_data;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mass_tax2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `mass_tax2`(p_valuationbasket int, p_tonebasket int,drivedrate float,drivedvalue float, p_username varchar(255))
BEGIN
	DECLARE l_grossvalue float;
	DECLARE l_valuedescretion float;
	DECLARE l_proposednt float; 
	DECLARE l_proposedrate float; 
	DECLARE l_calculatedrate float; 
	DECLARE l_proposedtax float; 
	DECLARE l_approvednt float; 
	DECLARE l_approvedrate float; 
	DECLARE l_adjustment float; 
	DECLARE l_approvedtax float; 
	DECLARE l_note text;
    DECLARE v_finished int default 0;
    DECLARE l_taxrate float;
    DECLARE l_landvalue float;
    DECLARE l_bldgvalue float;
    DECLARE l_additionalvalue float;
    DECLARE l_propid int;
    DECLARE l_zone varchar(10);
    DECLARE l_bldgstatus varchar(10);
    DECLARE l_proptype varchar(10);
    DECLARE l_termtype varchar(10);
    
    
	DECLARE property_cursor CURSOR FOR 
	select vd_id, tdi_parent_key, ap_bldgstatus_id, ap_propertytype_id from cm_appln_valdetl, cm_appln_parameter, cm_masterlist
	left join (select tdi_key, tdi_value,tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") zone
	on zone.tdi_key = ma_subzone_id
	where ap_vd_id  = vd_id and ma_id = vd_ma_id and vd_va_id = p_valuationbasket and  vd_approvalstatus_id in ('06','07');
	
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
		
	OPEN property_cursor;
	
    get_data: LOOP
		
        FETCH property_cursor INTO l_propid, l_zone, l_bldgstatus, l_proptype;
		IF v_finished = 1 THEN 
			LEAVE get_data;
		END IF;
        
        select trate_value into l_taxrate from cm_tone_taxrate where trate_zon_id = l_zone and 
		trate_ishasbuilding_id = l_bldgstatus and trate_proptype_id = l_proptype and trate_trlist_id = p_tonebasket limit 1;
        
        select ifnull(sum(vl_roundnetlandvalue),0) into l_landvalue from cm_appln_val_lot where vl_vd_id = l_propid;
       
        select ifnull(sum(vb_roundnetnt),0) into l_bldgvalue from cm_appln_val_bldg where vb_vd_id = l_propid;
        
        select ifnull(sum(vad_roundnetvalue),0) into l_additionalvalue from cm_appln_val_additional where vad_vd_id = l_propid;
        set l_grossvalue = 0;
        set l_proposednt = 0;
        set l_proposedtax = 0;
        if l_taxrate is not null then
			set l_valuedescretion = 0;
           
            
           
           
          select vt_valbase_id into l_termtype from cm_appln_valterm 
		inner join cm_appln_val on va_vt_id = vt_id
		inner join cm_appln_valdetl on  vd_va_id = va_id where vd_id = l_propid; 
		  if l_bldgstatus = 0 then
			 set l_grossvalue = l_landvalue +  l_additionalvalue + l_valuedescretion;
             
            if l_termtype = 2 then
				set l_grossvalue = ( l_grossvalue * ( drivedrate /100));
			end if;

		  else
            set l_grossvalue = (l_bldgvalue * 12)  +  l_additionalvalue + l_valuedescretion;
				
            
          end if; 
           
           
           set l_proposednt = l_grossvalue;
            
            
            set l_calculatedrate = 100;
            set l_adjustment = 0;
            set l_proposedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100);
            set l_approvedtax = l_proposednt * (l_taxrate/100) * (l_calculatedrate /100) + l_adjustment;
             
            if drivedrate  is null then
				set drivedrate = 0;
            end if;
          
            INSERT INTO `cm_appln_val_tax`
			(`vt_vd_id`,`vt_grossvalue`,`vt_valuedescretion`,`vt_proposednt`,`vt_proposedrate`,`vt_calculatedrate`,
			`vt_proposedtax`,`vt_approvednt`,`vt_approvedrate`,`vt_adjustment`,`vt_approvedtax`,`vt_note`,`vt_createby`,
			`vt_createdate`,`vt_updateby`,`vt_updatedate`,`vt_derivedrate`,`vt_derivedvalue`)
			VALUES(l_propid,l_grossvalue, l_valuedescretion, l_proposednt,l_taxrate,l_calculatedrate,l_proposedtax,
            l_proposednt, l_taxrate,l_adjustment,l_approvedtax,'auto valuation',p_username, now(),p_username, now(),drivedrate, l_grossvalue);
            
            update cm_appln_valdetl set vd_approvalstatus_id = '08' where vd_id = l_propid;
        end if;
        
    END LOOP get_data;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proce_filmanager` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proce_filmanager`(p_param TEXT)
BEGIN
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_approvepropreg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_approvepropreg`(p_baskedid int, p_username varchar(50),
p_module varchar(50),p_param text, p_paramid text, p_status varchar(50))
BEGIN
declare l_count int;
declare termid int;
declare basketid int;
declare total_count int;
declare termDate date;
declare enforceDate date;
declare termdesc varchar(250);
declare termDatenum int;
declare applntype varchar(50);
if p_module = 'inspection' then
	select count(*) into l_count from cm_propbasket where PB_ID = p_baskedid and PB_APPROVALSTATUS_ID= '02';
	if l_count = 0 then
		update cm_masterlist set ma_approvalstatus_id= '02', ma_approvalstatusby = p_username where ma_pb_id = p_baskedid;
		update cm_propbasket set PB_APPROVALSTATUS_ID= '02', PB_APPROVEDBY = p_username, PB_APPROVEDATE = NOW() where PB_ID = p_baskedid;
	end if;
end if;



if p_module = 'valuation' then
	select count(*) into l_count from cm_appln_val where va_id = p_baskedid and va_approvalstatus_id= '04';
	if l_count = 1 then
		update cm_appln_valdetl set vd_approvalstatus_id= '07', vd_approvalstatusby = p_username 
        where vd_va_id = p_baskedid;
		update cm_appln_val set va_approvalstatus_id= '05', va_approvedby = p_username, va_approvedate = NOW() where va_id = p_baskedid;
	end if;
end if;

if p_module = 'objection' then
	
	
		update cm_appln_valdetl set vd_approvalstatus_id= '14', vd_approvalstatusby = p_username 
        where vd_va_id = p_baskedid;
		update cm_appln_val set va_approvalstatus_id= '14', va_approvedby = p_username, va_approvedate = NOW() where va_id = p_baskedid;
        select va_vt_id into termid from cm_appln_val where va_id = p_baskedid;
        
        INSERT INTO `cm_objection`(`ob_vt_id`,`ob_createby`,`ob_createdate`,`ob_updateby`,`ob_updatedate`)
			VALUES(termid,
            p_username, now(), p_username, now());
	
end if;

if p_module = 'IPA' then 
	begin
		DECLARE _next TEXT DEFAULT NULL;
		DECLARE _nextlen INT DEFAULT NULL;
		DECLARE _value TEXT DEFAULT NULL;
        declare approved_count int;
		declare total_count int;
		declare l_basketid int;

		iterator:
		LOOP
		  
		  
		  IF LENGTH(TRIM(p_param)) = 0 OR p_param IS NULL THEN
			LEAVE iterator;
		  END IF;

		  
		  SET _next = SUBSTRING_INDEX(p_param,',',1);

		  
		  
		  
		  SET _nextlen = LENGTH(_next);

		  
		  SET _value = TRIM(_next);

		  
           update cm_masterlist set ma_approvalstatus_id= '03', ma_approvalstatusby = p_username where ma_id = _value;
		
			select ma_pb_id into l_basketid from cm_masterlist where ma_id = _value;
			select count(*) into total_count from cm_masterlist where ma_pb_id = l_basketid;
			select count(*) into approved_count from cm_masterlist where ma_approvalstatus_id= '03' and ma_pb_id = l_basketid;
			if total_count = approved_count then 
				update cm_propbasket set PB_APPROVALSTATUS_ID = '02' where pb_id = l_basketid;
			end if;
		

		  
		  
		  
		  
		  SET p_param = INSERT(p_param,1,_nextlen + 1,'');
		END LOOP;
    end;
    
    
    
	
end if;

if p_module = 'IPCA' then 
	update cm_masterlist set ma_approvalstatus_id= '02', ma_approvalstatusby = p_username where ma_id = p_baskedid;
    update cm_propbasket set PB_APPROVALSTATUS_ID = '01' where pb_id = (select ma_pb_id from cm_masterlist where ma_id = p_baskedid);
end if;

if p_module = 'DELP' then 
	
    begin
		declare basket_stage varchar(10);
        DECLARE _next TEXT DEFAULT NULL;
		DECLARE _nextlen INT DEFAULT NULL;
		DECLARE _value TEXT DEFAULT NULL;

		iterator:
		LOOP
		  
		  
		  IF LENGTH(TRIM(p_param)) = 0 OR p_param IS NULL THEN
			LEAVE iterator;
		  END IF;

		  
		  SET _next = SUBSTRING_INDEX(p_param,',',1);

		  
		  
		  
		  SET _nextlen = LENGTH(_next);

		  
		  SET _value = TRIM(_next);
			delete from cm_masterlist where ma_id = _value;
		  
		  
		  
		  
		  SET p_param = INSERT(p_param,1,_nextlen + 1,'');
		END LOOP;
    end;
end if;

if p_module = 'BASKETAP' then 
	update cm_propbasket set PB_APPROVALSTATUS_ID= '03', PB_APPROVEDBY = p_username, PB_APPROVEDATE = NOW() where PB_ID = p_baskedid;
end if;


if p_module = 'REVINS' then  
	
    begin
		declare basket_stage varchar(10);
        DECLARE _next TEXT DEFAULT NULL;
		DECLARE _nextlen INT DEFAULT NULL;
		DECLARE _value TEXT DEFAULT NULL;

		iterator:
		LOOP
		  
		  
		  IF LENGTH(TRIM(p_param)) = 0 OR p_param IS NULL THEN
			LEAVE iterator;
		  END IF;

		  
		  SET _next = SUBSTRING_INDEX(p_param,',',1);

		  
		  
		  
		  SET _nextlen = LENGTH(_next);

		  
		  SET _value = TRIM(_next);

		  update cm_appln_valdetl set vd_approvalstatus_id= '05', vd_approvalstatusby = p_username where vd_id = _value;
		  
		  
		  
		  SET p_param = INSERT(p_param,1,_nextlen + 1,'');
		END LOOP;
		
     
		
    
     end;
end if;

if p_module = 'APINS' then  
	begin
		declare basket_stage varchar(10);
        DECLARE _next TEXT DEFAULT NULL;
		DECLARE _nextlen INT DEFAULT NULL;
		DECLARE _value TEXT DEFAULT NULL;

		iterator:
		LOOP
		  
		  
		  IF LENGTH(TRIM(p_param)) = 0 OR p_param IS NULL THEN
			LEAVE iterator;
		  END IF;

		  
		  SET _next = SUBSTRING_INDEX(p_param,',',1);

		  
		  
		  
		  SET _nextlen = LENGTH(_next);

		  
		  SET _value = TRIM(_next);

		  
		  select va_approvalstatus_id into basket_stage from cm_appln_val inner join cm_appln_valdetl on vd_va_id = va_id
			where vd_id = _value limit 1;
			if basket_stage in ('04', '05') then
				update cm_appln_valdetl set vd_approvalstatus_id= '06', vd_approvalstatusby = p_username where vd_id = _value;
			else
				update cm_appln_valdetl set vd_approvalstatus_id= '07', vd_approvalstatusby = p_username where vd_id = _value;
			end if;
		  
		  
		  
		  SET p_param = INSERT(p_param,1,_nextlen + 1,'');
		END LOOP;
		
     
		
    
     end;
end if;



if p_module = 'APVAL' then  
	begin
		DECLARE _next TEXT DEFAULT NULL;
		DECLARE _nextlen INT DEFAULT NULL;
		DECLARE _value TEXT DEFAULT NULL;

		iterator:
		LOOP
		  
		  
		  IF LENGTH(TRIM(p_param)) = 0 OR p_param IS NULL THEN
			LEAVE iterator;
		  END IF;

		  
		  SET _next = SUBSTRING_INDEX(p_param,',',1);

		  
		  
		  
		  SET _nextlen = LENGTH(_next);

		  
		  SET _value = TRIM(_next);

		  
		  update cm_appln_valdetl set vd_approvalstatus_id= '10', vd_approvalstatusby = p_username where vd_id = _value and vd_approvalstatus_id in ('08','09');

		  
		  
		  
		  
		  SET p_param = INSERT(p_param,1,_nextlen + 1,'');
		END LOOP;
    end;
    
	
	
    
    
end if;


if p_module = 'REVVAL' then  

	begin
		DECLARE _next TEXT DEFAULT NULL;
		DECLARE _nextlen INT DEFAULT NULL;
		DECLARE _value TEXT DEFAULT NULL;

		iterator:
		LOOP
		  
		  
		  IF LENGTH(TRIM(p_paramid)) = 0 OR p_paramid IS NULL THEN
			LEAVE iterator;
		  END IF;

		  
		  SET _next = SUBSTRING_INDEX(p_paramid,',',1);

		  
		  
		  
		  SET _nextlen = LENGTH(_next);

		  
		  SET _value = TRIM(_next);
			
			if p_param = 'INS' THEN
				update cm_appln_valdetl set vd_approvalstatus_id = '05', vd_approvalstatusby = p_username where vd_id = _value;
			elseif p_param = 'VAL' THEN
				update cm_appln_valdetl set vd_approvalstatus_id = '07', vd_approvalstatusby = p_username where vd_id = _value AND vd_approvalstatus_id in ('08','09','10','11','12');
			end if;
			update cm_appln_val set va_approvalstatus_id = '06' where va_id = (select vd_va_id from cm_appln_valdetl where vd_id = _value );
			call proc_resetmass(_value,'I');
            
		  
		  update cm_appln_valdetl set vd_approvalstatus_id= '10', vd_approvalstatusby = p_username where vd_id = _value and vd_approvalstatus_id in ('08','09');

		  
		  
		  
		  
		  SET p_paramid = INSERT(p_paramid,1,_nextlen + 1,'');
		END LOOP;
    end;
    
	
end if;

if p_module = 'APTERM' then
	update cm_appln_valterm set vt_approvalstatus_id = '03' where vt_id = p_baskedid;
end if;

if p_module = 'APOBJ' then  
	select vt_applicationtype_id into applntype from cm_appln_val inner join 
    cm_appln_valterm on vt_id = va_vt_id where va_id = p_baskedid;
    if applntype = 'C' then
		update cm_appln_val set va_approvalstatus_id = '11' where va_id = p_baskedid;
		update cm_appln_valterm set vt_approvalstatus_id = '02' where vt_id in(select va_vt_id from cm_appln_val
        where va_id = p_baskedid);
    end if;
    if applntype = 'K' then
	update cm_appln_val set va_approvalstatus_id = '08' where va_id = p_baskedid;
	update cm_appln_valdetl set vd_approvalstatus_id = '11' where vd_va_id = p_baskedid;
        select va_vt_id into termid from cm_appln_val where va_id = p_baskedid;
        select count(*) into l_count from cm_objection where ob_vt_id = termid;
        if l_count = 0 then
			select YEAR(vt_termDate), vt_approvalstatusdate,vt_name into termDatenum, enforceDate,termdesc from cm_appln_valterm where vt_id = termid;
			INSERT INTO `cm_objection`(`ob_vt_id`,ob_listyear,ob_enforcedate,ob_desc,`ob_createby`,`ob_createdate`,`ob_updateby`,`ob_updatedate`)
			VALUES(termid,termDatenum,enforceDate,termdesc,
            p_username, now(), p_username, now());
		end if;
        
      /*  BEGIN
			DECLARE v_finished INTEGER DEFAULT 0;
			DECLARE account_id int;
			DECLARE l_count int;
			DECLARE l_objection_id int;
			DECLARE l_accno varchar(15);
			 DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id, vd_accno
			 FROM cm_appln_valdetl where vd_va_id = p_baskedid ;
			 
			 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
			 
			 OPEN accountnumber_cursor;
			 
			 get_account: LOOP
				 
				 FETCH accountnumber_cursor INTO account_id, l_accno;
				 
				 IF v_finished = 1 THEN 
				 LEAVE get_account;
				 END IF;
				 
                 select ob_id into l_objection_id from cm_objection where ob_vt_id = termid;
				 
				 select count(*) into l_count from cm_objection_notis where no_vd_id = account_id 
				 and no_ob_id = l_objection_id;
				 
				 if l_count = 0 then		 
					
						insert into cm_objection_notis(no_ob_id,no_vd_id,no_accno, no_createby,no_createdate,
						no_updateby,
						no_updatedate) values(l_objection_id, account_id, l_accno,
						p_username,now(),p_username, now());
						
						
					
				 end if;
				 
				 END LOOP get_account;
				 
				 close accountnumber_cursor;
				
		  
	END;*/
    
    end if;
end if;


if p_module = 'ENFORCE' then
	update cm_appln_valterm set vt_transferby = p_username, vt_transferDate =now(), vt_approvalstatus_id = '05' where vt_id = p_baskedid;
end if;


if p_module = 'planapprove1' then
	update cm_plan set plan_planstatus_id = '2' where plan_id = p_baskedid;
end if;

if p_module = 'planapprove' then
	update cm_plan set plan_planstatus_id = '2' where plan_id = p_baskedid;
end if;

if p_module = 'planapprove2' then
	update cm_plan set plan_planstatus_id = '4' where plan_id = p_baskedid;
end if;


if p_module = 'planapprove3' then
	update cm_plan set plan_planstatus_id = '9' where plan_id = p_baskedid;
end if;
if p_module = 'APDB' then
	update cm_appln_deactive set da_approved = '02',da_approvedby = p_username,da_approvedate = now() where da_id = p_baskedid;
end if;

if p_module = 'TRN' then
	call proc_taxtransfer(p_baskedid,p_username);
end if;

if p_module = 'tenant' then
	if p_param = '1' then
		update cm_tenant set te_approvaltestatus_id = '2',te_approvaltestatusby = p_username  where te_id = p_baskedid;
    end if;
    
    
    
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_tenant set te_approvaltestatus_id = '3',te_approvaltestatusby = p_username  
			where te_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_tenant set te_approvaltestatus_id = '4',te_approvaltestatusby = p_username  
			where te_id = p_baskedid;
        end if;		
    end if;
    
	if p_param = '3' then
		update cm_tenant set te_approvaltestatus_id = '5',te_approvaltestatusby = p_username  where te_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_tenant set te_approvaltestatus_id = '6',te_approvaltestatusby = p_username  where te_id = p_baskedid;
    end if;
end if;


if p_module = 'ratepayer' then
	if p_param = '1' then
		update cm_ratepayer set rp_approvalrpstatus_id = '2',rp_approvalrpstatusby = p_username  where rp_id = p_baskedid;
    end if;
    
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_ratepayer set rp_approvalrpstatus_id = '3',rp_approvalrpstatusby = p_username  
			where rp_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_ratepayer set rp_approvalrpstatus_id = '4',rp_approvalrpstatusby = p_username  
			where rp_id = p_baskedid;
        end if;		
    end if;
    
    
	if p_param = '3' then
		update cm_ratepayer set rp_approvalrpstatus_id = '5',rp_approvalrpstatusby = p_username  where rp_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_ratepayer set rp_approvalrpstatus_id = '6',rp_approvalrpstatusby = p_username  where rp_id = p_baskedid;
    end if;
    
end if;

if p_module = 'evidentmgmt' then
	if p_param = '1' then
		update cm_transaction set trans_approvaltransstatus_id = '2',trans_approvaltransstatusby = p_username  where trans_id = p_baskedid;
    end if;
    
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_transaction set trans_approvaltransstatus_id = '3',trans_approvaltransstatusby = p_username  
			where trans_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_transaction set trans_approvaltransstatus_id = '4',trans_approvaltransstatusby = p_username  
			where trans_id = p_baskedid;
        end if;		
    end if;
    
    
	if p_param = '3' then
		update cm_transaction set trans_approvaltransstatus_id = '5',trans_approvaltransstatusby = p_username  where trans_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_transaction set trans_approvaltransstatus_id = '6',trans_approvaltransstatusby = p_username  where trans_id = p_baskedid;
    end if;
    
end if;

if p_module = 'tonebasket' then
	if p_param = '1' then
		update cm_toneoflistbasket set tollis_activeind_id = '2',tollis_approvaltollisstatusby = p_username  where tollist_id = p_baskedid;
    end if;
    
	if p_param = '2' then
		update cm_toneoflistbasket set tollis_activeind_id = '1',tollis_approvaltollisstatusby = p_username  where tollist_id = p_baskedid;
    end if;
    
end if;

if p_module = 'ratebasket' then
	if p_param = '1' then
		update cm_taxratelistbasket set trlist_activeind_id = '2'  where trlist_id = p_baskedid;
    end if;
    
	if p_param = '2' then
		update cm_taxratelistbasket set trlist_activeind_id = '1'  where trlist_id = p_baskedid;
    end if;
    
end if;




if p_module = 'tonebldg' then
	if p_param = '1' then 
		update cm_tone_building set tbldg_approvalbldgstatus_id = '2',tbldg_approvalbldgstatusby = p_username  
        where FIND_IN_SET(tbldg_id,p_paramid) ; -- tbldg_id = p_baskedid; -- and tbldg_approvalbldgstatus_id = 1;
    end if;
    
	if p_param = '2' then
		if p_status = 'AP' then
			update cm_tone_building set tbldg_approvalbldgstatus_id = '3',tbldg_approvalbldgstatusby = p_username  
			where FIND_IN_SET(tbldg_id,p_paramid);
        elseif p_status = 'RJ' then
			update cm_tone_building set tbldg_approvalbldgstatus_id = '4',tbldg_approvalbldgstatusby = p_username  
			where FIND_IN_SET(tbldg_id,p_paramid);
        end if;		
    end if;
    
	if p_param = '3' then
		update cm_tone_building set tbldg_approvalbldgstatus_id = '5',tbldg_approvalbldgstatusby = p_username  where FIND_IN_SET(tbldg_id,p_paramid);
        -- and tbldg_approvalbldgstatus_id = 3;
    end if;
    
	if p_param = '5' then
		update cm_tone_building set tbldg_approvalbldgstatus_id = '6',tbldg_approvalbldgstatusby = p_username  where FIND_IN_SET(tbldg_id,p_paramid);
        -- and tbldg_approvalbldgstatus_id = 5;
    end if;
    
    /*
	if p_param = '5' then
		update cm_tone_building set tbldg_approvalbldgstatus_id = '6',tbldg_approvalbldgstatusby = p_username  where tbldg_id = p_baskedid;
    end if;*/
    
end if;


if p_module = 'toneland' then
	if p_param = '1' then
		update cm_tone_land set tland_approvaltlandstatus_id = '2',tland_approvaltlandstatusby = p_username  where tland_id = p_baskedid;
    end if;
    
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_tone_land set tland_approvaltlandstatus_id = '3',tland_approvaltlandstatusby = p_username  
			where tland_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_tone_land set tland_approvaltlandstatus_id = '4',tland_approvaltlandstatusby = p_username  
			where tland_id = p_baskedid;
        end if;		
    end if;
    
	    
	if p_param = '3' then
		update cm_tone_land set tland_approvaltlandstatus_id = '5',tland_approvaltlandstatusby = p_username  where tland_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_tone_land set tland_approvaltlandstatus_id = '6',tland_approvaltlandstatusby = p_username  where tland_id = p_baskedid;
    end if;
end if;

if p_module = 'toneallowance' then
	if p_param = '1' then
		update cm_tone_bldg_allowances set tallo_approvaltallostatus_id = '2',tallo_approvaltallostatusby = p_username  
        where tallo_id = p_baskedid;
    end if;
    
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_tone_bldg_allowances set tallo_approvaltallostatus_id = '3',tallo_approvaltallostatusby = p_username  
			where tallo_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_tone_bldg_allowances set tallo_approvaltallostatus_id = '4',tallo_approvaltallostatusby = p_username  
			where tallo_id = p_baskedid;
        end if;		
    end if;
    
	if p_param = '3' then
		update cm_tone_bldg_allowances set tallo_approvaltallostatus_id = '5',tallo_approvaltallostatusby = p_username  where tallo_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_tone_bldg_allowances set tallo_approvaltallostatus_id = '6',tallo_approvaltallostatusby = p_username  where tallo_id = p_baskedid;
    end if;
end if;
    
if p_module = 'tonedepreciation' then
	if p_param = '1' then
		update cm_tone_bldg_depreciation set tdepre_approvaltdeprestatus_id = '2',tdepre_approvaltdeprestatusby = p_username  where tdepre_id = p_baskedid;
    end if;
    
	if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_tone_bldg_depreciation set tdepre_approvaltdeprestatus_id = '3',tdepre_approvaltdeprestatusby = p_username  
			where tdepre_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_tone_bldg_depreciation set tdepre_approvaltdeprestatus_id = '4',tdepre_approvaltdeprestatusby = p_username  
			where tdepre_id = p_baskedid;
        end if;		
    end if;
    
	if p_param = '3' then
		update cm_tone_bldg_depreciation set tdepre_approvaltdeprestatus_id = '5',tdepre_approvaltdeprestatusby = p_username  where tdepre_id = p_baskedid;
    end if;
        
	if p_param = '5' then
		update cm_tone_bldg_depreciation set tdepre_approvaltdeprestatus_id = '6',tdepre_approvaltdeprestatusby = p_username  where tdepre_id = p_baskedid;
    end if;
end if;

if p_module = 'tonelandstandart' then
	if p_param = '1' then
		update cm_tone_land_standart set tstand_approvaltstandstatus_id = '2',tstand_approvaltstandstatusby = p_username  where tstand_id = p_baskedid;
    end if;
    
	
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_tone_land_standart set tstand_approvaltstandstatus_id = '3',tstand_approvaltstandstatusby = p_username  
			where tstand_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_tone_land_standart set tstand_approvaltstandstatus_id = '4',tstand_approvaltstandstatusby = p_username  
			where tstand_id = p_baskedid;
        end if;		
    end if;
    
	if p_param = '3' then
		update cm_tone_land_standart set tstand_approvaltstandstatus_id = '5',tstand_approvaltstandstatusby = p_username  where tstand_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_tone_land_standart set tstand_approvaltstandstatus_id = '6',tstand_approvaltstandstatusby = p_username  where tstand_id = p_baskedid;
    end if;
end if;

if p_module = 'taxrate' then
	if p_param = '1' then
		update cm_tone_taxrate set trate_approvaltratestatus_id = '2',trate_approvaltratestatusby = p_username  where trate_id = p_baskedid;
    end if;
    
    if p_param = '2' then
		if p_paramid = 'AP' then
			update cm_tone_taxrate set trate_approvaltratestatus_id = '3',trate_approvaltratestatusby = p_username  
			where trate_id = p_baskedid;
        elseif p_paramid = 'RJ' then
			update cm_tone_taxrate set trate_approvaltratestatus_id = '4',trate_approvaltratestatusby = p_username  
			where trate_id = p_baskedid;
        end if;		
    end if;
    
	if p_param = '3' then
		update cm_tone_taxrate set trate_approvaltratestatus_id = '5',trate_approvaltratestatusby = p_username  where trate_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
		update cm_tone_taxrate set trate_approvaltratestatus_id = '6',trate_approvaltratestatusby = p_username  where trate_id = p_baskedid;
    end if;
end if;

if p_module = 'ownershiptrans' then
	if p_param = '2' then
        update cm_ownertrans_applnreg set otar_ownertransstatus_id = 4, otar_updateby = p_username,
        otar_updatedate = now() where otar_id = p_baskedid and otar_ownertransstatus_id=2;
    end if;
    
	if p_param = '4' then
		if p_status = 'AP' then
			update cm_ownertrans_applnreg set otar_ownertransstatus_id = 5, otar_updateby = p_username,
			otar_updatedate = now() where otar_id = p_baskedid and otar_ownertransstatus_id=4;
        elseif p_status = 'RJ' then
			update cm_ownertrans_applnreg set otar_ownertransstatus_id = 6, otar_updateby = p_username,
			otar_updatedate = now() where otar_id = p_baskedid and otar_ownertransstatus_id=4;
        end if;		
    end if;
    
    
	if p_param = '5' then
        update cm_ownertrans_applnreg set otar_ownertransstatus_id = 7, otar_updateby = p_username,
        otar_updatedate = now() where otar_id = p_baskedid and otar_ownertransstatus_id=5;
    end if;
   
end if;

if p_module = 'officialsearch' then

	if p_param = '1' then
        update cm_officialsearch set os_officialsearchstatus_id = 2, os_updateby = p_username,
        os_approvalstatusdate =  now() , os_approvalstatusby =p_username,
        os_updatedate = now() where os_id = p_baskedid;
    end if;
    
	
	if p_param = '2' then
		if p_status = 'AP' then
			update cm_officialsearch set os_officialsearchstatus_id = 3, os_updateby = p_username,
           os_approvalstatusdate =  now() , os_approvalstatusby =p_username,
			os_updatedate = now() where os_id = p_baskedid ;
        elseif p_status = 'RJ' then
			update cm_officialsearch set os_officialsearchstatus_id = 4, os_updateby = p_username,
           os_approvalstatusdate =  now() , os_approvalstatusby =p_username,
			os_updatedate = now() where os_id = p_baskedid;
        end if;		
    end if;
    
    if p_param = '3' then
		update cm_officialsearch set os_officialsearchstatus_id = 5, os_updateby = p_username,
        os_approvalstatusdate =  now() , os_approvalstatusby =p_username,
        os_updatedate = now() where os_id = p_baskedid;
    end if;
    
    
	if p_param = '5' then
        update cm_officialsearch set os_officialsearchstatus_id = 6, os_updateby = p_username,
        os_approvalstatusdate =  now() , os_approvalstatusby =p_username,
        os_updatedate = now() where os_id = p_baskedid;
    end if;
   
end if;

if p_module = 'propertyaddress' then
	
	if p_param = '2' then
        update cm_masterlist_log set mal_approvalstatus_id = 4, mal_updateby = p_username,
        mal_approvalstatusby =  now() , mal_approvalstatusby =p_username,
        mal_updatedate = now() where mal_id = p_baskedid;
    end if;
    
	if p_param = '4' then
		if p_status = 'AP' then
			update cm_masterlist_log set mal_approvalstatus_id = 5, mal_updateby = p_username,
			mal_approvalstatusby =  now() , mal_approvalstatusby =p_username,
			mal_updatedate = now() where mal_id = p_baskedid;
        elseif p_status = 'RJ' then
			update cm_masterlist_log set mal_approvalstatus_id = 6, mal_updateby = p_username,
			mal_approvalstatusby =  now() , mal_approvalstatusby =p_username,
			mal_updatedate = now() where mal_id = p_baskedid;
        end if;		
    end if;
    
    if p_param = '5' then
		update cm_masterlist_log set mal_approvalstatus_id = 7, mal_updateby = p_username,
		mal_approvalstatusby =  now() , mal_approvalstatusby =p_username,
		mal_updatedate = now() where mal_id = p_baskedid;
    end if;
    
   
end if;


if p_module = 'propertylotaddress' then
	
	if p_param = '2' then
        update cm_lot_log set log_approvalstatus_id = 4, log_createdby = p_username,
        log_updatedate = now() where log_id = p_baskedid;
    end if;
    
	if p_param = '4' then
		if p_status = 'AP' then
        update cm_lot_log set log_approvalstatus_id = 5, log_createdby = p_username,
        log_updatedate = now() where log_id = p_baskedid;
        elseif p_status = 'RJ' then
			
        update cm_lot_log set log_approvalstatus_id = 6, log_createdby = p_username,
        log_updatedate = now() where log_id = p_baskedid;
        end if;		
    end if;
    
    if p_param = '5' then		
        update cm_lot_log set log_approvalstatus_id =7, log_createdby = p_username,
        log_updatedate = now() where log_id = p_baskedid;
    end if;
    
   
end if;


if p_module = 'remisi' then
	
	if p_param = '0' then
        update cm_remisi_reg set rg_remisistatus_id = 2, rg_updateby = p_username,
        rg_updateat = now() where rg_id = p_baskedid;
    end if;
    
    
    if p_param = '1' then		
        update cm_remisi_reg set rg_remisistatus_id = 2, rg_updateby = p_username,
        rg_updateat = now() where rg_id = p_baskedid;
    end if;
    
    if p_param = '2' then		
        update cm_remisi_reg set rg_remisistatus_id = 3, rg_updateby = p_username,
        rg_updateat = now() where rg_id = p_baskedid;
    end if;
    if p_param = '3' then		
        update cm_remisi_reg set rg_remisistatus_id = 4, rg_updateby = p_username,
        rg_updateat = now() where rg_id = p_baskedid;
    end if;
    if p_param = '5' then		
        update cm_remisi_reg set rg_remisistatus_id = 5, rg_updateby = p_username,
        rg_updateat = now() where rg_id = p_baskedid;
    end if;
    if p_param = '6' then		
        update cm_remisi_reg set rg_remisistatus_id = 6, rg_updateby = p_username,
        rg_updateat = now() where rg_id = p_baskedid;
    end if;
   
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmapplndeactive_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmapplndeactive_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE l_vt_id int;
	DECLARE l_name varchar(200);
	DECLARE l_operation int;
    DECLARE l_count int;

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.name'))) INTO l_name;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
 
	if l_operation = 1 then   
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.termid'))) INTO l_vt_id;
		select count(*) into l_count from cm_appln_deactive where `da_name` = l_name and `da_vt_id` = l_vt_id;
        if l_count = 0 then
			INSERT INTO `cm_appln_deactive`(`da_vt_id`,`da_name`,`da_createdby`,`da_createddate`,`da_updateby`,
            `da_updateddate`,da_approved)
			VALUES(l_vt_id, l_name, p_username, now(), p_username, now(),'01');
		 end if;
    end if;
    
    if l_operation = 2 then            
		
		UPDATE cm_appln_deactive SET `da_name` = l_name,`da_updateby` = p_username,`da_updateddate` = now()
         WHERE `da_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_appln_deactive WHERE `da_id` = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmapplnvaltem_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmapplnvaltem_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE l_name varchar(50);
	DECLARE l_termdate varchar(30);
	DECLARE l_termdt date;
	DECLARE l_applntype varchar(5);
	DECLARE l_termbase varchar(5);
	DECLARE l_operation int;
    DECLARE l_count int;

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.name'))) INTO l_name;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.applicationtype'))) INTO l_applntype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.termdate'))) INTO l_termdate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.termbase'))) INTO l_termbase;
    
	if l_operation = 1 then   
	set l_termdt = DATE_FORMAT(STR_TO_DATE(l_termdate, '%d/%m/%Y'), '%Y-%m-%d');
		select count(*) into l_count from cm_appln_valterm where `vt_name` = l_name;
        if l_count = 0 then
			INSERT INTO `cm_appln_valterm`(`vt_name`,`vt_createby`,`vt_createdate`,`vt_updateby`,
            `vt_updatedate`,`vt_applicationtype_id`, `vt_termDate`, `vt_approvalstatus_id`,`vt_valbase_id`)
			VALUES(l_name, p_username, now(), p_username, now(), l_applntype, l_termdt, '01',l_termbase);
		 end if;
    end if;
    
    if l_operation = 2 then      
	set l_termdt = DATE_FORMAT(STR_TO_DATE(l_termdate, '%d/%m/%Y'), '%Y-%m-%d');
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.termdate'))) INTO l_termdate;      
		UPDATE cm_appln_valterm SET `vt_name` = l_name, `vt_applicationtype_id` = l_applntype, `vt_valbase_id` = l_termbase
        , `vt_termDate` = l_termdt,`vt_updateby` = p_username,`vt_updatedate` = now()
         WHERE vt_id = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_appln_valterm WHERE vt_id = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmapplnval_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmapplnval_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE l_vt_id int;
	DECLARE l_name varchar(200);
	DECLARE l_operation int;
    DECLARE l_count int;

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.name'))) INTO l_name;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
 
	if l_operation = 1 then   
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.termid'))) INTO l_vt_id;
		select count(*) into l_count from cm_appln_val where `va_name` = l_name and `va_vt_id` = l_vt_id;
        if l_count = 0 then
			INSERT INTO `cm_appln_val`(`va_vt_id`,`va_name`,`va_createby`,`va_createdate`,`va_updateby`,
            `va_updatedate`,`va_approvalstatus_id`)
			VALUES(l_vt_id, l_name, p_username, now(), p_username, now(),'04');
		 end if;
    end if;
    
    if l_operation = 2 then            
		
		UPDATE cm_appln_val SET `va_name` = l_name,`va_updateby` = p_username,`va_updatedate` = now()
         WHERE `va_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_appln_val WHERE `va_id` = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmlot_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmlot_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE lotype varchar(150);
DECLARE lotnum varchar(150);
DECLARE altlotnum varchar(10);
DECLARE lottitlenum varchar(55);
DECLARE lottitletype varchar(55);
DECLARE alttitlenum varchar(8);
DECLARE landar int DEFAULT 0;
DECLARE landarunit varchar(50);
DECLARE lancond varchar(50);
DECLARE lanposition varchar(50);
DECLARE roadtype varchar(50);
DECLARE roadcategory varchar(50);
DECLARE landuse varchar(50);
DECLARE expresscond varchar(1000);
DECLARE interest varchar(1000);
DECLARE tenuretype varchar(50);
DECLARE tenureperiod int DEFAULT 0;
DECLARE st_tenstartdt varchar(50);
DECLARE st_tenenddt varchar(50);
DECLARE tenstartdt varchar(50);
DECLARE tenenddt varchar(50);
DECLARE landstatus varchar(10);
DECLARE landstatus_id int;
DECLARE l_master_id int;
DECLARE lottyp_id varchar(50);
DECLARE title_type_id varchar(50);
DECLARE unit_id varchar(50);
DECLARE landcond_id varchar(5);
DECLARE landpos_id varchar(5);
DECLARE roadtype_id varchar(5);
DECLARE roadcategory_id varchar(5);
DECLARE stratano varchar(50);
DECLARE tenanttype_id varchar(5);
DECLARE landuse_id varchar(5);
DECLARE l_count int default 0;
DECLARE l_lotid int default 0;
DECLARE operation int default 0;
 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lotype')))) INTO lotype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lotnum')))) INTO lotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.altlotnum')))) INTO lottitletype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lttt')))) INTO lottitletype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ltnum')))) INTO lottitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.altnum')))) INTO alttitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tentype')))) INTO tenuretype; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tenduration')))) INTO tenureperiod; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tenstart')))) INTO st_tenstartdt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tenend')))) INTO st_tenenddt; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.stratano')))) INTO stratano; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.al_id')))) INTO l_id; 
	  
	-- if p_type = 'update' then
		 
			UPDATE cm_lot_log SET `log_lotcode_id` = lotype, `log_no` = lotnum
			, `log_altno` = lottitletype, `log_alttitleno` = alttitlenum, `log_tenuretype_id` = tenuretype
			, `log_tenureperiod` = tenureperiod,  `log_startdate` =  DATE_FORMAT(STR_TO_DATE(st_tenstartdt, '%d/%m/%Y'), '%Y-%m-%d'),
			`log_expireddate` =  DATE_FORMAT(STR_TO_DATE(st_tenenddt, '%d/%m/%Y'), '%Y-%m-%d')
			,`log_titletype_id` = lottitletype, log_approvalstatus_id = 2, log_stratano = stratano
			 WHERE log_id = l_id;
		-- end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmmasterlist_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmmasterlist_trn`(in p_param TEXT, in p_username varchar(100), in p_transtatus varchar(50))
BEGIN
	DECLARE l_id int;
	DECLARE l_vt_id int;
	DECLARE l_accountnumber varchar(12);
	DECLARE l_filenumber varchar(30);
    DECLARE l_district varchar(30);
	DECLARE l_subzone varchar(50);
	DECLARE l_address1 varchar(50);
	DECLARE l_address2 varchar(50);
	DECLARE l_address3 varchar(50);
	DECLARE l_address4 varchar(50);
	DECLARE l_postcode varchar(6);
	DECLARE l_city varchar(50);
	DECLARE l_state varchar(2);

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.filenumber'))) INTO l_filenumber;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address1'))) INTO l_address1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address2'))) INTO l_address2;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address3'))) INTO l_address3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address4'))) INTO l_address4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.postcode'))) INTO l_postcode;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.city	'))) INTO l_city;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.state'))) INTO l_state;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.subzone'))) INTO l_subzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.accountnumber'))) INTO l_accountnumber;
	  
	INSERT INTO `cm_masterlist_log` (`mal_accno`,`mal_fileno`,`mal_subzone_id`,
	`mal_addr_ln1`,`mal_addr_ln2`,`mal_addr_ln3`,`mal_addr_ln4`,`mal_postcode`,`mal_city`,`mal_state_id`,
    `mal_createby`,`mal_createdate`,
	`mal_updateby`,`mal_updatedate`,`ota_transtocenterdate`, `ota_transtocenterby`, `ota_transtocenterstatus_id`)
	VALUES(l_accountnumber,l_filenumber,l_subzone, l_address1, l_address2, l_address3, l_address4,
    l_postcode, l_city, l_state, p_username, now(), p_username, now(), now(), p_username, p_transtatus);
    
    /*update cm_masterlist_log set mal_fileno = l_filenumber,mal_addr_ln1 = l_address1, mal_addr_ln2 = l_address2, 
    mal_addr_ln3 = l_address3, mal_addr_ln4 = l_address4, mal_city = l_city,
    mal_state_id = l_state, mal_postcode = l_postcode, mal_updateby = p_username, mal_updatedate = now(),
    mal_approvalstatus_id = '2'
    where mal_accno = l_accountnumber;*/
    
    /*update cm_masterlist set ma_fileno = l_filenumber,ma_addr_ln1 = l_address1, ma_addr_ln2 = l_address2, 
    ma_addr_ln3 = l_address3, ma_addr_ln4 = l_address4, ma_city = l_city,
    ma_state_id = l_state, ma_postcode = l_postcode, ma_updateby = p_username, ma_updatedate = now()
    where ma_accno = l_accountnumber;*/
    
  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmobjection_agenda_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmobjection_agenda_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE l_ob_id int;
	DECLARE l_desc varchar(50);
	DECLARE l_siries varchar(50);
	DECLARE l_operation int;
    DECLARE l_count int;

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.desc'))) INTO l_desc;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.siries'))) INTO l_siries;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.ob_id'))) INTO l_ob_id;
 
	if l_operation = 1 then   
		
      
			INSERT INTO `cm_objection_agenda`(`ag_ob_id`,`ag_siries`,`ag_desc`,`ag_createby`,`ag_createdate`,
            `ag_updateby`,`ag_updatedate`)
			VALUES(l_ob_id, l_siries, l_desc, p_username, now(), p_username, now());
		
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_objection_agenda SET `ag_siries` = l_siries,`ag_desc` = l_desc,
        `ag_updateby` = p_username,`ag_updatedate` = now()
         WHERE `ag_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		delete from cm_objection_agendadetail where agd_ag_id = l_id;
		DELETE FROM cm_objection_agenda WHERE `ag_id` = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmobjection_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmobjection_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE l_vt_id int;
	DECLARE l_desc varchar(50);
	DECLARE l_listyear varchar(4);
	DECLARE l_meetingdate varchar(50);
	DECLARE l_notis8date varchar(50);
	DECLARE l_notis8hijridate varchar(45); 
	DECLARE l_notis9date varchar(50);
	DECLARE l_notis9hijridate varchar(45);
	DECLARE l_notis10date varchar(50); 
	DECLARE l_notis10hijridate varchar(50);
	DECLARE l_notis8printdate varchar(50); 
	DECLARE l_enforcedate varchar(50);
	DECLARE l_operation int;
    DECLARE l_count int;

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.desc'))) INTO l_desc;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.listyear'))) INTO l_listyear;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.meetingdate'))) INTO l_meetingdate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis8date'))) INTO l_notis8date;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis8hijridate'))) INTO l_notis8hijridate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis9date'))) INTO l_notis9date;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis9hijridate'))) INTO l_notis9hijridate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis10date'))) INTO l_notis10date;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis10hijridate'))) INTO l_notis10hijridate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.notis8printdate'))) INTO l_notis8printdate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.enforcedate'))) INTO l_enforcedate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.termid'))) INTO l_vt_id;
 
	if l_operation = 1 then   
		
      
			INSERT INTO `cm_objection`(`ob_vt_id`,`ob_desc`,`ob_listyear`,`ob_meetingdate`,`ob_notis8date`,`ob_notis8hijridate`,
`ob_notis9date`,`ob_notis9hijridate`,`ob_notis10date`,`ob_notis10hijridate`,`ob_notis8printdate`,
`ob_enforcedate`,`ob_createby`,`ob_createdate`,`ob_updateby`,`ob_updatedate`)
			VALUES(l_vt_id, l_desc, l_listyear, DATE_FORMAT(STR_TO_DATE(l_meetingdate, '%d/%m/%Y'), '%Y-%m-%d'), 
            DATE_FORMAT(STR_TO_DATE(l_meetingdate, '%d/%m/%Y'), '%Y-%m-%d'), l_notis8hijridate,
            DATE_FORMAT(STR_TO_DATE(l_notis9date, '%d/%m/%Y'), '%Y-%m-%d'), l_notis9hijridate, 
            DATE_FORMAT(STR_TO_DATE(l_notis10date, '%d/%m/%Y'), '%Y-%m-%d'), l_notis10hijridate, 
            DATE_FORMAT(STR_TO_DATE(l_notis8printdate, '%d/%m/%Y'), '%Y-%m-%d'), 
            DATE_FORMAT(STR_TO_DATE(l_enforcedate, '%d/%m/%Y'), '%Y-%m-%d'),
            p_username, now(), p_username, now());
		
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_objection SET `ob_vt_id` = l_vt_id,`ob_desc` = l_desc,`ob_listyear` = l_listyear,`ob_meetingdate` = DATE_FORMAT(STR_TO_DATE(l_meetingdate, '%d/%m/%Y'), '%Y-%m-%d'),
        `ob_notis8date` = DATE_FORMAT(STR_TO_DATE(l_notis8date, '%d/%m/%Y'), '%Y-%m-%d'),`ob_notis8hijridate` = l_notis8hijridate,`ob_notis9date` = DATE_FORMAT(STR_TO_DATE(l_notis9date, '%d/%m/%Y'), '%Y-%m-%d'),
        `ob_notis9hijridate` = l_notis9hijridate,`ob_notis10date` = DATE_FORMAT(STR_TO_DATE(l_notis10date, '%d/%m/%Y'), '%Y-%m-%d'),`ob_notis10hijridate` = l_notis10hijridate,
        `ob_notis8printdate` = DATE_FORMAT(STR_TO_DATE(l_notis8printdate, '%d/%m/%Y'), '%Y-%m-%d'),`ob_enforcedate` = DATE_FORMAT(STR_TO_DATE(l_enforcedate, '%d/%m/%Y'), '%Y-%m-%d'),`ob_updateby` = p_username,`ob_updatedate` = now()
         WHERE `ob_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		delete from cm_objection_agendadetail where agd_ag_id in (select ag_id from cm_objection_agenda where 
        ag_ob_id = l_id);
        delete from cm_objection_agenda where ag_ob_id = l_id;
        delete from cm_objection_notis where no_ob_id = l_id;
        delete from cm_objection_objectionlist where ol_ob_id = l_id;
        delete from cm_objection_decision where de_ob_id = l_id;
		delete from cm_objection where `ob_id` = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmofficialsearch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmofficialsearch`(p_param text, p_id int, p_user varchar(50))
BEGIN
	declare l_count int;    
	declare l_id int;
	DECLARE l_name varchar(100);
	DECLARE l_addrln1 varchar(100);
	DECLARE l_addrln2 varchar(100);
	DECLARE l_addrln3 varchar(100);
	DECLARE l_addrln4 varchar(100);
	DECLARE l_city varchar(100);
	DECLARE l_postcode varchar(100);
	DECLARE l_state varchar(100);
	DECLARE l_appref varchar(100);
	DECLARE l_ref varchar(100);
	DECLARE l_date varchar(100);
	DECLARE l_hdate varchar(100);
	DECLARE l_letterdate varchar(100);
	DECLARE l_operation varchar(100);

	
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.name'))) INTO l_name;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addrln1'))) INTO l_addrln1;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addrln2'))) INTO l_addrln2;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addrln3'))) INTO l_addrln3;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addrln4'))) INTO l_addrln4;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.city'))) INTO l_city;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.postcode'))) INTO l_postcode;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.state'))) INTO l_state;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.appref'))) INTO l_appref;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.ref'))) INTO l_ref;    
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.date'))) INTO l_date;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.hdate'))) INTO l_hdate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.letterdate'))) INTO l_letterdate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
    
    if l_operation = 1 then
		select count(*) into l_count from cm_officialsearch where os_vd_id = p_id;
		if l_count = 0 then
			insert into cm_officialsearch(os_vd_id, os_officialsearchstatus_id, os_createby, os_createdate, os_updateby, os_updatedate,
			os_applnname, os_applnaddr_ln1, os_applnaddr_ln2, os_applnaddr_ln3, os_applnaddr_ln4, os_city,
			os_postcode, os_state, os_ref, os_applnno, os_applndate, os_applnhijridate, os_applnletterdate )
			values(p_id, '1', p_user, now(), p_user, now(), l_name, l_addrln1, l_addrln2, l_addrln3, l_addrln4,
			l_city, l_postcode, l_state, l_appref, l_ref, l_date, l_hdate, l_letterdate);
		end if;
    
    end if;
    
    if  l_operation = 2 then
		update cm_officialsearch set os_applnname = l_name, os_applnaddr_ln1 =l_addrln1, os_applnaddr_ln2 = l_addrln2,
        os_applnaddr_ln3 =l_addrln3, os_applnaddr_ln4 = l_addrln4, os_city = l_city,
		os_postcode = l_postcode, os_state = l_state, os_ref = l_appref, os_applnno = l_ref, os_applndate = l_date,
		os_applnhijridate = l_hdate, os_applnletterdate  = l_letterdate, os_updateby = p_user, os_updatedate = now()
		where os_id = l_id;
    end if;
    
    if  l_operation = 3 then
		delete from  cm_officialsearch where os_id = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmownertransapplnreg_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmownertransapplnreg_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE res varchar(4000);
DECLARE owneraccnum varchar(15);
DECLARE ownaplntype varchar(30);
DECLARE typeofown varchar(55);
DECLARE ownnum varchar(55);
DECLARE ownname varchar(80);
DECLARE ownaddr1 varchar(150);
DECLARE ownaddr2 varchar(150);
DECLARE ownaddr3 varchar(150);
DECLARE ownaddr4 varchar(150);
DECLARE ownpostcode varchar(10);
DECLARE ownstate varchar(55);

DECLARE addname varchar(80);
DECLARE addaddr1 varchar(150);
DECLARE addaddr2 varchar(150);
DECLARE addaddr3 varchar(150);
DECLARE addaddr4 varchar(150);
DECLARE addpostcode varchar(10);
DECLARE addstate varchar(10);
DECLARE recievedate varchar(55);
DECLARE requestdate varchar(55);
DECLARE transactionprice float;
DECLARE transactiondate varchar(55);
DECLARE refno varchar(55);
DECLARE apprefno varchar(55);
DECLARE rejectreason1 varchar(200);
DECLARE rejectreason2 varchar(200);
DECLARE rejectreason3 varchar(200);
DECLARE rejectreason4 varchar(200);
DECLARE rejectreason5 varchar(200);
DECLARE rejectreason6 varchar(200);


DECLARE citizen varchar(55);
DECLARE state_id varchar(50);
DECLARE telno varchar(15);
DECLARE faxno varchar(15);
DECLARE race varchar(55);
DECLARE demominator int default 0;
DECLARE race_id varchar(10);
DECLARE citizen_id varchar(10);
DECLARE owntype_id varchar(10);
DECLARE l_master_id int;
DECLARE l_count int;
DECLARE l_ownerid int default 0;
DECLARE operation int;
DECLARE actioncode varchar(10);

    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.owneraccnum')))) INTO owneraccnum;
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaplntype')))) INTO ownaplntype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntypeofown')))) INTO typeofown;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownnum')))) INTO ownnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr1')))) INTO ownaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr2')))) INTO ownaddr2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr3')))) INTO ownaddr3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr4')))) INTO ownaddr4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownpostcode')))) INTO ownpostcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownstate')))) INTO ownstate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntelno')))) INTO telno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nfaxno')))) INTO faxno; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ncitizen')))) INTO citizen; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nrace')))) INTO race; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ndemominator')))) INTO demominator; 
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addname')))) INTO addname; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr1')))) INTO addaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr2')))) INTO addaddr2; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr3')))) INTO addaddr3; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr4')))) INTO addaddr4; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addpostcode')))) INTO addpostcode; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addstate')))) INTO addstate; 
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reqdate')))) INTO requestdate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addacceptdt')))) INTO recievedate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrndate')))) INTO transactiondate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrnvalue')))) INTO transactionprice; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addref')))) INTO refno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addapplicatref')))) INTO apprefno;
    
  
    
		 select ma_id into l_master_id from cm_masterlist where ma_accno = owneraccnum;

		   if demominator = '' then 
			set  @demominator = 0;
		   end if; 
		   
		   
		update cm_owner set  `TO_OWNERAPPLNTYPE_ID` = ownaplntype,`TO_OWNTYPE_ID` = typeofown,
		`TO_OWNNO` = ownnum,`TO_OWNNAME` = ownname,`TO_ADDR_LN1` = ownaddr1,`TO_ADDR_LN2` = ownaddr2,
		`TO_ADDR_LN3` = ownaddr3,`TO_ADDR_LN4` = ownaddr4,`TO_POSTCODE` = ownpostcode,`TO_STATE_ID` = ownstate,
		`TO_CITIZEN_ID` = citizen,`TO_RACE_ID` = race,`TO_DENOMTR` = demominator,
		`TO_UPDATEBY` = p_username,`TO_UPDATEDATE` = now(), TO_TELNO = telno,TO_FAXNO = faxno
		WHERE `TO_MA_ID` = l_master_id;
        
        insert into cm_ownertrans_applnreg(`ota_transferapplntype_id`,`ota_transferapplntypestatus_id`,
		`ota_owntype_id`,`ota_ownno`,`ota_ownname`,`ota_addr_ln1`,`ota_addr_ln2`,`ota_addr_ln3`,
		`ota_addr_ln4`,`ota_postcode`,`ota_state_id`,`ota_citizen_id`,`ota_race_id`,`ota_phoneno`,
		`ota_denomtr`,`ota_agentname`,`ota_agentaddr_ln1`,`ota_agentaddr_ln2`,`ota_agentaddr_ln3`,
		`ota_agentaddr_ln4`,`ota_agentpostcode`,`ota_agentstate_id`,
		`ota_applydate`,`ota_recievedate`,`ota_transactionprice`,`ota_transactiondate`,`ota_agentrefno`,`ota_rejectreason1`,
		`ota_rejectreason2`,`ota_transtocenterstatus_id`,
		`ota_createby`,`ota_createdate`,
		`ota_updateby`,`ota_updatedate`)
		VALUES (ownaplntype, '', typeofown, ownnum, ownname, ownaddr1, ownaddr2, ownaddr3, ownaddr4, ownpostcode, ownstate,
		citizen, race, telno, demominator,addname, addaddr1, addaddr2 , addaddr3, addaddr4, addpostcode, addstate,
		 DATE_FORMAT(STR_TO_DATE(requestdate, '%d/%m/%Y'), '%Y-%m-%d'), DATE_FORMAT(STR_TO_DATE(recievedate, '%d/%m/%Y'), '%Y-%m-%d'),
		 transactionprice, DATE_FORMAT(STR_TO_DATE(transactiondate, '%d/%m/%Y'), '%Y-%m-%d'), refno, '', '', '0', p_username, now(), p_username, now() );
				
	
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmplan_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmplan_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
	DECLARE l_id int;
	DECLARE l_fileno varchar(50);
	DECLARE l_desc text;
	DECLARE l_applntyp varchar(50);
	DECLARE l_plandate varchar(50);
	DECLARE l_cccdate varchar(50);
	DECLARE l_valuationdate varchar(50);
	DECLARE l_lotno varchar(50);
	DECLARE l_zoneid varchar(50);
	DECLARE l_receivedate varchar(50);
	DECLARE l_occupieddate varchar(50);
	DECLARE l_note text;
	DECLARE l_operation int;
    DECLARE l_count int;
    DECLARE l_status varchar(50);

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.fileno'))) INTO l_fileno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.plandesc'))) INTO l_desc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.applicationtype'))) INTO l_applntyp;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.zone'))) INTO l_zoneid;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.nolot'))) INTO l_lotno;
    SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.plandate'))),null) INTO l_plandate;
    SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.cccdate'))),null) INTO l_cccdate;
    SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.valdate'))),null) INTO l_valuationdate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.note'))) INTO l_note;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.status'))) INTO l_status;
	if l_operation = 1 then   
      
		INSERT INTO `cm_plan`(`plan_fileno`,`plan_desc`,`plan_planapplicationtype`,`plan_plandate`,
		`plan_cccdate`,`plan_lotno`, `plan_note`, `plan_zon_id`, `plan_createby`, `plan_createdate`,`plan_updateby`, `plan_updatedate`
		,`plan_receiveby`, `plan_receivedate`, `plan_planstatus_id`, `plan_valuationdate` )
		VALUES(l_fileno, l_desc, l_applntyp,  ifnull(DATE_FORMAT(STR_TO_DATE(l_plandate, '%d/%m/%Y'), '%Y-%m-%d'),null), 
		ifnull(DATE_FORMAT(STR_TO_DATE(l_cccdate, '%d/%m/%Y'), '%Y-%m-%d'),null), l_lotno,l_note, l_zoneid,
		p_username, now(), p_username, now(), p_username, now(), '1',ifnull(DATE_FORMAT(STR_TO_DATE(l_valuationdate, '%d/%m/%Y'), '%Y-%m-%d'),null) );
		
    end if;
    
    if l_operation = 2 then      
	    
		UPDATE cm_plan SET `plan_fileno` = l_fileno, `plan_desc` = l_desc, `plan_note` = l_note
        , `plan_planapplicationtype` = l_applntyp,`plan_plandate` = ifnull(DATE_FORMAT(STR_TO_DATE(l_plandate, '%d/%m/%Y'), '%Y-%m-%d'),null),`plan_lotno` = l_lotno,
        `plan_cccdate` = ifnull(DATE_FORMAT(STR_TO_DATE(l_cccdate, '%d/%m/%Y'), '%Y-%m-%d'),null), plan_valuationdate = ifnull(DATE_FORMAT(STR_TO_DATE(l_valuationdate, '%d/%m/%Y'), '%Y-%m-%d'),null),
        plan_planstatus_id = l_status
         WHERE plan_id = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_plan WHERE plan_id = l_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmpropask_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmpropask_trn`(
	IN `basketname` VARCHAR(50),
	IN `p_operation` INT,
	IN `basket_id` INT,
	IN `username` VARCHAR(50)
)
BEGIN     
   
    if p_operation = 1 then     
       
        
            insert into cm_propbasket( PB_NAME,PB_CREATEBY,PB_CREATEDATE,PB_UPDATEBY,PB_UPDATEDATE) values (basketname,
            username, now(), username, now());  
            
        
        
        
         
    end if;

    if p_operation = 2 then
       update cm_propbasket set PB_NAME = basketname,PB_UPDATEBY = username,PB_UPDATEDATE = now()
       where PB_ID = basket_id;   
    end if;

    if p_operation = 3 then
       delete from cm_propbasket where PB_ID = basket_id;
    end if;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmpropbasket_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmpropbasket_trn`(
	IN `basketname` VARCHAR(50),
	IN `applicationtype` VARCHAR(3),
	IN `p_operation` INT,
	IN `basket_id` INT,
	IN `username` VARCHAR(50),
	IN `proptype` VARCHAR(50)
)
BEGIN 
   DECLARE l_count INT;
    if p_operation = 1 then     
            insert into cm_propbasket(PB_NAME,PB_CREATEBY,PB_CREATEDATE,PB_UPDATEBY,PB_UPDATEDATE, PB_APPROVALSTATUS_ID,
            PB_APPLICATIONTYPE_ID, PB_PROPBASKETTYE_ID) values (basketname,
            username, now(), username, now(),'01', applicationtype,proptype);         
    end if;

    if p_operation = 2 then
       update cm_propbasket set PB_NAME = basketname,PB_UPDATEBY = username,PB_UPDATEDATE = now()
       where PB_ID = basket_id;   
    end if;

    if p_operation = 3 then
		select count(*) into l_count from cm_propbasket where PB_ID = basket_id and PB_APPROVALSTATUS_ID = '01';
		if l_count = 1 then
			delete from cm_propbasket where PB_ID = basket_id;
		end if;
    end if;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmratepayer_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmratepayer_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_applntype_id varchar(1);
DECLARE l_type_id varchar(3);
DECLARE l_no varchar(15);
DECLARE l_name varchar(80);
DECLARE l_addr_ln1 varchar(50);
DECLARE l_addr_ln2 varchar(50); 
DECLARE l_addr_ln3 varchar(50);
DECLARE l_addr_ln4 varchar(50);
DECLARE l_postcode varchar(6);
DECLARE l_state_id varchar(2);
DECLARE l_citizen_id varchar(50);
DECLARE l_race_id varchar(3);
DECLARE l_phoneno varchar(50);
DECLARE l_email varchar(50);
DECLARE l_activeind_id varchar(1);
DECLARE l_operation int;
DECLARE l_count int;


	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.applntypeid'))) INTO l_applntype_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.typeid'))) INTO l_type_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.number'))) INTO l_no;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.name'))) INTO l_name;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr1'))) INTO l_addr_ln1;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr2'))) INTO l_addr_ln2;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr3'))) INTO l_addr_ln3;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr4'))) INTO l_addr_ln4;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.postcode'))) INTO l_postcode;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.stateid'))) INTO l_state_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.citizenid'))) INTO l_citizen_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.raceid'))) INTO l_race_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.activeindid'))) INTO l_activeind_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.phoneno'))) INTO l_phoneno;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.emailid'))) INTO l_email;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.ratepayerid'))) INTO l_id;

	if l_operation = 1 then   
		select count(*) into l_count from cm_ratepayer where rp_type_id = l_type_id and rp_applntype_id = l_applntype_id
        and rp_no = l_no;
        if l_count = 0 then
			INSERT INTO `cm_ratepayer`(`rp_applntype_id`,`rp_type_id`,`rp_no`,`rp_name`,`rp_addr_ln1`,`rp_addr_ln2`,`rp_addr_ln3`,
			`rp_addr_ln4`,`rp_postcode`,`rp_state_id`,`rp_citizen_id`,`rp_race_id`,`rp_activeind_id`,rp_phone_no,
			rp_email_addr,`rp_createby`,`rp_createdate`,
			`rp_updateby`,`rp_updatedate`)
			VALUES(l_applntype_id, l_type_id, l_no, l_name, l_addr_ln1, l_addr_ln2, l_addr_ln3, l_addr_ln4, 
			l_postcode, l_state_id, l_citizen_id, l_race_id, l_activeind_id, l_phoneno, l_email, p_username, now(), p_username, now());
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_ratepayer SET `rp_applntype_id` = l_applntype_id,`rp_type_id` = l_type_id,`rp_no` = l_no,`rp_name` = l_name,
        `rp_addr_ln1` = l_addr_ln1,`rp_addr_ln2` = l_addr_ln2,`rp_addr_ln3` = l_addr_ln3,
		`rp_addr_ln4` = l_addr_ln4,`rp_postcode` = l_postcode,`rp_state_id` = l_state_id,`rp_citizen_id` = l_citizen_id,
        `rp_race_id` = l_race_id,`rp_activeind_id` = l_activeind_id, rp_phone_no = l_phoneno, rp_email_addr = l_email, `rp_updateby` = p_username,
        `rp_updatedate` = now() WHERE rp_id = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_ratepayer WHERE rp_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmremisi_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmremisi_trn`(in p_param TEXT, in p_insparam TEXT, in p_user varchar(100))
BEGIN
	DECLARE res varchar(4000);
	DECLARE l_accno varchar(15);
	DECLARE l_reff varchar(30);
	DECLARE l_applydate varchar(55);
	DECLARE l_applntname varchar(55);
	DECLARE l_applntaddr_ln1 varchar(80);
	DECLARE l_applntaddr_ln2 varchar(150);
	DECLARE l_applntaddr_ln3 varchar(150);
	DECLARE l_applntaddr_ln4 varchar(150);
	DECLARE l_applntcity varchar(150);
	DECLARE l_applntstate_id varchar(10);
	DECLARE l_applntvacancystartdate varchar(55);
	DECLARE l_applntvacancyenddate varchar(55);
	DECLARE l_applntvacancyperiod varchar(150);
	DECLARE l_regofficer varchar(150);
	DECLARE l_regofficerdate varchar(150);
	DECLARE l_revacancystartdate varchar(10);
	DECLARE l_revacancyenddate varchar(55);
	DECLARE l_redecision_id varchar(55);

	DECLARE l_reamount varchar(80);
	DECLARE l_reimplementdate varchar(150);
	DECLARE l_rerejectreason1 varchar(150);
	DECLARE l_rerejectreason2 varchar(150);
	DECLARE l_rerejectreason3 varchar(150);
	DECLARE l_rerejectreason4 varchar(10);
	DECLARE l_reofficer varchar(10);
	DECLARE l_reofficerdate varchar(55);
	DECLARE l_desiofficer varchar(55);
	DECLARE l_desiofficerdate float;
	DECLARE l_status varchar(10);
	DECLARE l_id int;
	DECLARE msg int DEFAULT 0;

	DECLARE actioncode varchar(10);

   -- SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.owneraccnum')))) INTO l_accno;    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appref')))) INTO l_reff ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appltdate')))) INTO  l_applydate ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appname')))) INTO  l_applntname ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appddr1')))) INTO  l_applntaddr_ln1 ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appddr2')))) INTO  l_applntaddr_ln2 ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appddr3')))) INTO  l_applntaddr_ln3 ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appddr4')))) INTO  l_applntaddr_ln4;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appcity')))) INTO  l_applntcity ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.appstate')))) INTO  l_applntstate_id ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.vstartdt')))) INTO  l_applntvacancystartdate ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.venddt')))) INTO  l_applntvacancyenddate ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.resultoffi')))) INTO  l_regofficer ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.resultdate')))) INTO  l_regofficerdate ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.vacantsdate')))) INTO  l_revacancystartdate ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.vacantedate')))) INTO  l_revacancyenddate;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.decision')))) INTO  l_redecision_id;

	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.insamount')))) INTO  l_reamount;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.impldate')))) INTO  l_reimplementdate ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.rjreason1')))) INTO  l_rerejectreason1 ;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.rjreason2')))) INTO  l_rerejectreason2;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.rjreason3')))) INTO  l_rerejectreason3;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.status')))) INTO  l_status;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.id')))) INTO  l_id ;
	
    
    
        
	update cm_remisi_reg set rg_reff = l_reff, rg_applydate=l_applydate, rg_applntname=l_applntname,rg_applntaddr_ln1=l_applntaddr_ln1,
    rg_applntaddr_ln2=l_applntaddr_ln2,rg_applntaddr_ln3=l_applntaddr_ln3,rg_applntaddr_ln4=l_applntaddr_ln4,rg_applntcity=l_applntcity,
    rg_applntstate_id=l_applntstate_id, rg_applntvacancystartdate=l_applntvacancystartdate,rg_applntvacancyenddate=l_applntvacancyenddate,
    rg_regofficer=l_regofficer,rg_regofficerdate =l_regofficerdate, rg_revacancystartdate=l_revacancystartdate,rg_revacancyenddate=l_revacancyenddate,
    rg_redecision_id=l_redecision_id, rg_reamount=l_reamount, rg_reimplementdate=l_reimplementdate,rg_rerejectreason1=l_rerejectreason1,
    rg_rerejectreason2=l_rerejectreason2, rg_redecision_id=l_redecision_id
    where rg_id = l_id;
   
    set @msg = fn_remisi_inspection(p_insparam,p_user, l_id);
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_cmtenant_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cmtenant_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_applntype_id varchar(1);
DECLARE l_type_id varchar(3);
DECLARE l_no varchar(15);
DECLARE l_name varchar(80);
DECLARE l_addr_ln1 varchar(50);
DECLARE l_addr_ln2 varchar(50); 
DECLARE l_addr_ln3 varchar(50);
DECLARE l_addr_ln4 varchar(50);
DECLARE l_postcode varchar(6);
DECLARE l_state_id varchar(2);
DECLARE l_citizen_id varchar(50);
DECLARE l_race_id varchar(3);
DECLARE l_phone_no varchar(15);
DECLARE l_emailid varchar(100);
DECLARE l_activeind_id varchar(1);
DECLARE l_operation int;
DECLARE l_count int;

	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.applntypeid'))) INTO l_applntype_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.typeid'))) INTO l_type_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.number'))) INTO l_no;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.name'))) INTO l_name;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr1'))) INTO l_addr_ln1;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr2'))) INTO l_addr_ln2;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr3'))) INTO l_addr_ln3;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.addr4'))) INTO l_addr_ln4;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.postcode'))) INTO l_postcode;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.stateid'))) INTO l_state_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.citizenid'))) INTO l_citizen_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.raceid'))) INTO l_race_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.activeindid'))) INTO l_activeind_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.tenantid'))) INTO l_id;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.phoneno'))) INTO l_phone_no;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.emailid'))) INTO l_emailid;

	if l_operation = 1 then 
		select count(*) into l_count from cm_tenant where te_type_id = l_type_id and te_applntype_id = l_applntype_id
        and te_no = l_no;
        if l_count = 0 then
			INSERT INTO `cm_tenant`(`te_applntype_id`,`te_type_id`,`te_no`,`te_name`,`te_addr_ln1`,`te_addr_ln2`,`te_addr_ln3`,
			`te_addr_ln4`,`te_postcode`,`te_state_id`,`te_citizen_id`,`te_race_id`,`te_activeind_id`,`te_createby`,`te_createdate`,
			`te_updateby`,`te_updatedate`,te_phone_no, te_email_addr)
			VALUES(l_applntype_id, l_type_id, l_no, l_name, l_addr_ln1, l_addr_ln2, l_addr_ln3, l_addr_ln4, 
			l_postcode, l_state_id, l_citizen_id, l_race_id, l_activeind_id, p_username, now(), p_username, now(),l_phone_no, l_emailid);
        end if;
    end if;
    
    if l_operation = 2 then     
		
			UPDATE cm_tenant SET `te_applntype_id` = l_applntype_id,`te_type_id` = l_type_id,`te_no` = l_no,`te_name` = l_name,
			`te_addr_ln1` = l_addr_ln1,`te_addr_ln2` = l_addr_ln2,`te_addr_ln3` = l_addr_ln3,
			`te_addr_ln4` = l_addr_ln4,`te_postcode` = l_postcode,`te_state_id` = l_state_id,`te_citizen_id` = l_citizen_id,
			`te_race_id` = l_race_id,`te_activeind_id` = l_activeind_id,`te_updateby` = p_username,
			te_phone_no = l_phone_no, te_email_addr = l_emailid,
			`te_updatedate` = now() WHERE te_id = l_id;
        
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tenant WHERE te_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_data_objection_agenda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_data_objection_agenda`(in p_condition text)
BEGIN
	set p_condition = replace(p_condition, 'ag_siries = "not null"', 'ag_siries is not null');
	set p_condition = replace(p_condition, 'ag_siries = "is null"', 'ag_siries is null');
	SET @query_str = CONCAT("select vd_id, va_vt_id, vd_accno, ag_siries, va_name, ob_listyear
        from cm_appln_valdetl inner join cm_appln_val on va_id = vd_va_id
        inner join cm_appln_valterm on vt_id = va_vt_id
        inner join cm_masterlist on ma_id = vd_ma_id
        left join (select ag_siries,agd_vd_id,ob_listyear from cm_objection_agendadetail 
        inner join cm_objection_agenda on ag_id = agd_ag_id
        inner join cm_objection on ob_id = ag_ob_id) cm_objection_agendadetail on agd_vd_id = vd_id
        inner join tbdefitems subzone  on subzone.tdi_key = ma_subzone_id and tdi_td_name = 'SUBZONE'
        where va_approvalstatus_id in ('08','09') and va_vt_id = ",p_condition );
    
    PREPARE stmt FROM @query_str;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_existspropertymaintenance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_existspropertymaintenance`(p_param TEXT,p_basket_id INT,
p_username varchar(55))
BEGIN
	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE v_finished2 INTEGER DEFAULT 0;
	DECLARE account_id int;
	DECLARE l_count int;
	DECLARE l_ishasbuilding_id varchar(50);
	DECLARE l_accno varchar(15);
	DECLARE l_val_accountid int;
	DECLARE l_val_bldgid int;
	DECLARE l_val_newbldgid int;
	DECLARE l_bldgtype varchar(15);
	DECLARE l_bldgcategory varchar(15);
	DECLARE l_bldgstorey varchar(15);
	DECLARE l_va_vt_id int;
    
    update cm_masterlist set ma_pb_id = p_basket_id where  FIND_IN_SET(ma_accno,p_param);
    
	/*DEClARE accountnumber_cursor CURSOR FOR SELECT ma_id,ma_ishasbuilding_id,ma_accno FROM cm_masterlist where FIND_IN_SET(ma_accno,p_param); -- and ma_approvalstatus_id = '03';

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

	set p_newprop  = 0;
	OPEN accountnumber_cursor;

	grap_account: LOOP

		FETCH accountnumber_cursor INTO account_id, l_ishasbuilding_id,l_accno;
		IF v_finished = 1 THEN 
			LEAVE grap_account;
		END IF;

		if l_count = 0 then
			update cm_masterlist set ma_pb_id = p_basket_id where ;
			SELECT p_newprop + 1 INTO p_newprop;
		end if;

	END LOOP grap_account;
	CLOSE accountnumber_cursor;*/
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_filmanager` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_filmanager`(p_param TEXT,data_removed TEXT, p_type VARCHAR(20), 
filename varchar(30), description text, propid int)
BEGIN
DECLARE i int;
DECLARE l_type varchar(200);
DECLARE l_hash text ;
DECLARE l_name varchar(200);
DECLARE l_url text ;
DECLARE l_fs_id int ;
DECLARE l_parent text ;
DECLARE l_old_hash text;
DECLARE l_ts text;
DECLARE l_count int;

set data_removed = REPLACE(data_removed, '[', '');
set data_removed =  REPLACE(data_removed, ']', '');
set data_removed = REPLACE(data_removed, '"', '');
set data_removed =  REPLACE(data_removed, '"', '');
if p_type = 'ATTACHMENT' then
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.mime')))) INTO l_type;		
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.hash')))) INTO l_hash;		
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.name')))) INTO l_name;	
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.url')))) INTO l_url;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.phash')))) INTO l_parent;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ts')))) INTO l_ts;
	
			insert into cm_attachment(at_name,`at_attachtype_id`,`at_linkid`,`at_fs_id`,`at_filename`,`at_oringinalfilename`,`at_detail`,`at_path`,`at_hash`,`at_createby`,`at_createdate`,`at_updateby`,`at_updatedate`) 
			values(l_name,'01',propid,0,l_name,filename,description, '\\public\\FileServer\\files',l_hash,'admin',now(),'admin',now());
end if;
if p_type = 'INSATTACHMENT' then
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.mime')))) INTO l_type;		
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.hash')))) INTO l_hash;		
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.name')))) INTO l_name;	
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.url')))) INTO l_url;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.phash')))) INTO l_parent;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ts')))) INTO l_ts;
	
			insert into cm_attachment(at_name,`at_attachtype_id`,`at_linkid`,`at_fs_id`,`at_filename`,`at_oringinalfilename`,`at_detail`,`at_path`,`at_hash`,`at_createby`,`at_createdate`,`at_updateby`,`at_updatedate`) 
			values(l_name,'01',propid,0,l_name,filename,description, l_url,l_hash,'admin',now(),'admin',now());
end if;


if p_type = 'ADD' then
    
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.mime')))) INTO l_type;		
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.hash')))) INTO l_hash;		
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.name')))) INTO l_name;	
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.url')))) INTO l_url;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.phash')))) INTO l_parent;
	SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ts')))) INTO l_ts;

    if data_removed <> '' then
		if l_type = 'directory' then
            select fs_id into l_fs_id from cm_filestructurel where `hash` = data_removed;
			update cm_filestructurel set `fd_name` = l_name , `hash` = l_hash where `hash` = data_removed;
			update cm_filestructurel set  `hash` = REPLACE(`hash`,data_removed,l_hash) where `fd_parent` = l_fs_id;
			update cm_attachment set  `at_hash` = REPLACE(`at_hash`,data_removed,l_hash) where `at_fs_id` = l_fs_id;
        else
			select fs_id into l_fs_id from cm_filestructurel where `hash` = data_removed;
			update cm_attachment set `at_filename` = l_name , `at_path` = l_url,`at_hash` = l_hash,
            `at_updateby` = 'admin',`at_updatedate` = now()
            where `at_hash` like concat('%',data_removed,'%');
			
        end if;
    else
		if l_type = 'directory' then
		select count(*) into l_count from cm_filestructurel where `hash` = l_hash;
			select fs_id into l_fs_id from cm_filestructurel where `hash` = l_parent;
			insert into cm_filestructurel(`fd_name`,`fd_path`,`hash`,`fd_parent`) values(l_name,l_url,l_hash,l_fs_id);
		else
			select fs_id into l_fs_id from cm_filestructurel where `hash` = l_parent;
			insert into cm_attachment(`at_fs_id`,`at_filename`,`at_path`,`at_hash`,`at_createby`,`at_createdate`,`at_updateby`,`at_updatedate`) 
			values(l_fs_id,l_name,l_url,l_hash,'admin',now(),'admin',now());
		end if;
    end if;
	
end if;


if p_type = 'REMOVE' then
    select fs_id into l_fs_id from cm_filestructurel where `hash` like concat('%',data_removed);
	delete from cm_attachment where at_fs_id = l_fs_id;
    delete from cm_filestructurel where `fd_parent` = l_fs_id;
	delete from cm_filestructurel where `hash` like concat('%',data_removed,'%');
   delete from cm_attachment where at_hash = data_removed;
end if;

if p_type = 'delete' then
   
	delete from cm_attachment where at_id = propid;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_grabdata` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_grabdata`(p_param TEXT,p_basket_id INT,
p_username varchar(55),p_type varchar(100),p_reason varchar(100),p_desc varchar(100), out p_newprop INT)
BEGIN
	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE v_finished2 INTEGER DEFAULT 0;
	DECLARE account_id int;
	DECLARE l_count int;
	DECLARE l_ishasbuilding_id varchar(50);
	DECLARE l_accno varchar(15);
	DECLARE l_val_accountid int;
	DECLARE l_val_bldgid int;
 
begin
	 DEClARE accountnumber_cursor CURSOR FOR SELECT ma_id,ma_ishasbuilding_id,ma_accno FROM cm_masterlist where FIND_IN_SET(ma_accno,p_param) and ma_approvalstatus_id = '03';
	 
	 
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
if p_type = 'editdeactivateproperty' then
	
begin

DECLARE hasbulding varchar(10);
	 DECLARE bldgtype varchar(10);
	 DECLARE bldgstorey varchar(10);
	
     update cm_appln_deactivedetl set dad_reason_id = p_reason,dad_desc = p_desc where FIND_IN_SET(dad_id,p_param) ;
	
         end;
 end if;

	if p_type = 'add' then



	begin
		DECLARE l_bldgtype varchar(15);
		DECLARE l_bldgcategory varchar(15);
		DECLARE l_bldgstorey varchar(15);
		
		set p_newprop  = 0;
		 OPEN accountnumber_cursor;
	 
			 grap_account: LOOP
		
			 FETCH accountnumber_cursor INTO account_id, l_ishasbuilding_id,l_accno;
			 IF v_finished = 1 THEN 
			 LEAVE grap_account;
			 END IF;
			
			 
			 select count(*) into l_count from cm_appln_valdetl where vd_ma_id = account_id and vd_va_id = p_basket_id;
			 
			 if l_count = 0 then
			 
					select  `BL_BLDGTYPE_ID`,`BL_BLDGSTOREY_ID` into l_bldgtype, l_bldgstorey          
					from `cm_bldg` where BL_MA_ID =  account_id and  BL_ISMAINBLDG_ID = 'Y' limit 1; 
				
					select  tdi_parent_key into l_bldgcategory         
					from `tbdefitems` where tdi_td_name =  'BULDINGTYPE' and  tdi_key = l_bldgtype; 
					
					insert into cm_appln_valdetl(vd_va_id,vd_ma_id,vd_ishasbuilding,vd_accno,vd_createby,
					vd_createdate,vd_updateby, vd_updatedate,vd_approvalstatus_id,vd_isfirsttime_id, vd_bldgtype_id, vd_bldgstorey_id) values(p_basket_id, account_id,
					l_ishasbuilding_id, l_accno,p_username,now(),p_username, now(),'04','1', l_bldgtype, l_bldgstorey);
					
					SELECT LAST_INSERT_ID() into l_val_accountid;
					
					insert into cm_appln_parameter(ap_vd_id, ap_bldgstatus_id, ap_propertytype_id,ap_propertylevel_id,
					ap_propertycategory_id)
					values(l_val_accountid,l_ishasbuilding_id, l_bldgtype, l_bldgstorey, l_bldgcategory);
										
					insert into cm_appln_lot(al_vd_id,al_state,al_district,al_lotcode_id,al_no,
					al_altno,al_titletype_id,al_titleno,al_alttitleno,al_size,al_sizeunit_id,al_landcondition_id,
					al_landposision_id,al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id,
					al_tenureperiod, al_startdate,al_expireddate, al_activeind_id,al_createby, al_createdate,al_updateby, 
					al_updatedate ) SELECT l_val_accountid,   `LO_STATE`,    `LO_DISTRICT`,   
					`LO_LOTCODE_ID`,    `LO_NO`,    `LO_ALTNO`,    `LO_TITLETYPE_ID`,    `LO_TITLENO`,    `LO_ALTTITLENO`,
					`LO_SIZE`,    `LO_SIZEUNIT_ID`,    `LO_LANDCONDITION_ID`,    `LO_LANDPOSITION_ID`,    `LO_ROADTYPE_ID`,
					`LO_ROADCATEGORY_ID`,    `LO_LANDUSE_ID`,    `LO_EXCD`,    `LO_RTIT`,    `LO_TENURETYPE_ID`,    `LO_TENUREPERIOD`,
					null,   null,    `LO_ACTIVEIND_ID`,    p_username,    now(),
					p_username,    now()  FROM `cm_lot` where LO_MA_ID =  account_id;
					
					INSERT INTO  cm_appln_bldg (`ab_vd_id`,   `ab_bldg_no`,   `ab_bldgtype_id`,   `ab_bldgstorey_id`,   `ab_bldgcondn_id`,
				   `ab_bldgposition_id`,   `ab_bldgstructure_id`,   `ab_rooftype_id`,   `ab_walltype_id`,   `ab_floortype_id`,
				   `ab_cccdate`,   `ab_occupieddate`,   `ab_ismainbldg_id`,   `ab_createby`,   `ab_createdate`,   `ab_updateby`,
				   `ab_updatedate`) SELECT  l_val_accountid,`BL_BLDG_NO`,`BL_BLDGTYPE_ID`,`BL_BLDGSTOREY_ID`,`BL_BLDGCONDN_ID`,`BL_BLDGPOSITION_ID`,
					`BL_BLDGSTRUCTURE_ID`,`BL_ROOFTYPE_ID`,`BL_WALLTYPE_ID`,`BL_FLOORTYPE_ID`,BL_CCCDATE,
					BL_OCCUPIEDDATE,`BL_ISMAINBLDG_ID`,
					p_username,    now(),    p_username,    now() from `cm_bldg` where BL_MA_ID =  account_id;	
					
                   -- SELECT LAST_INSERT_ID() into l_val_bldgid;
					
					begin
						 DECLARE bldgid int(11);
						 DECLARE bldgnumber varchar(255);
						 DEClARE bldg_cursor CURSOR FOR SELECT bl_id,bl_bldg_no FROM cm_bldg where bl_ma_id = account_id;
						 
						 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;					
						 
						 OPEN bldg_cursor;
						 
						 bldg_area: LOOP
						     
							 FETCH bldg_cursor INTO bldgid, bldgnumber;
							 
							 IF v_finished = 1 THEN 
							 LEAVE bldg_area;
							 END IF;
							 
							 select ab_id into l_val_bldgid from cm_appln_bldg where ab_bldg_no = bldgnumber and ab_vd_id = l_val_accountid;
							 
							 INSERT INTO `cm_appln_bldgarea` (`aba_ab_id`,`aba_ref`,`aba_areatype_id`,`aba_arealevel_id`,`aba_areacategory_id`,
							`aba_areazone_id`,`aba_areause_id`,`aba_areadesc`,`aba_dimention`,`aba_unitcount`,`aba_size`,`aba_sizeunit_id`,`aba_totsize`,
							`aba_floortype_id`,`aba_walltype_id`,`aba_ceilingtype_id`,`aba_createby`,`aba_createdate`,`aba_updateby`,`aba_updatedate`)
							 select l_val_bldgid,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,
							`BA_AERAUSE_ID`,`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZE`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,
							`BA_WALLTYPE_ID`,`BA_CEILINGTYPE_ID`,p_username,    now(),    p_username,    now() from `cm_bldgarea` where
							 BA_BL_ID = bl_id;
							 
						 END LOOP bldg_area;
						  CLOSE bldg_cursor;
					end;
				
				
				SELECT p_newprop + 1 INTO p_newprop;
			 end if;
			 
			 END LOOP grap_account;
			  CLOSE accountnumber_cursor;
			 end;
	 end if;


 end;
 
 if p_type = 'delete' then
	begin
     DEClARE deleteaccountnumber_cursor CURSOR FOR select vd_id from cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) and vd_va_id = p_basket_id;
	 
	 
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished2 = 1;
    
  

		OPEN deleteaccountnumber_cursor;

		 get_deleteaccount: LOOP
		 
			 FETCH deleteaccountnumber_cursor INTO l_val_accountid;

			 IF v_finished2 = 1 THEN 
			 LEAVE get_deleteaccount;
			 END IF;
			 
			delete from cm_appln_lot where al_vd_id = l_val_accountid;
			delete from cm_appln_bldgarea where aba_ab_id in (select ab_id from cm_appln_bldg  where ab_vd_id =   l_val_accountid);
			delete from cm_appln_bldg where ab_vd_id = l_val_accountid;
			delete from cm_appln_valdetl where vd_id = l_val_accountid;
			delete from cm_appln_ratepayer where arp_vd_id = l_val_accountid;
			delete from cm_appln_tenant where at_vd_id = l_val_accountid;
            
		END LOOP get_deleteaccount;
		CLOSE deleteaccountnumber_cursor;
	end;
    COMMIT;
 end if;

 
begin
	DECLARE propertyid int;
	 DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id, vd_ma_id,vd_ishasbuilding,vd_accno FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) ;
	 
	 

if p_type = 'addexists' then
	begin
	DECLARE hasbulding varchar(10);
	 DECLARE bldgtype varchar(10);
	 DECLARE bldgstorey varchar(10);
	 DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id,vd_ma_id,vd_ishasbuilding,vd_accno FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) ;
     
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
     DECLARE exit handler for sqlexception
	 set p_newprop = 0;
	 OPEN accountnumber_cursor;

		 get_account: LOOP
		 
		 FETCH accountnumber_cursor INTO propertyid, account_id, l_ishasbuilding_id,l_accno;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_appln_valdetl where vd_ma_id = account_id and vd_va_id = p_basket_id;
		 
         if l_count = 0 then
		 
			select ap_bldgstatus_id, ap_propertytype_id, ap_propertylevel_id into hasbulding, bldgtype, bldgstorey 
            from cm_appln_parameter where ap_vd_id = propertyid;

				insert into cm_appln_valdetl(vd_va_id,vd_ma_id,vd_ishasbuilding,vd_bldgtype_id,vd_bldgstorey_id, vd_accno,vd_createby,
				vd_createdate,vd_updateby, vd_updatedate,vd_approvalstatus_id,vd_isfirsttime_id) values(p_basket_id, account_id,
				hasbulding, bldgtype, bldgstorey, l_accno,p_username,now(),p_username, now(),'04','1');
				
				SELECT LAST_INSERT_ID() into l_val_accountid;
				
								
				insert into cm_appln_lot(al_vd_id,al_state,al_district,al_lotcode_id,al_no,
				al_altno,al_titletype_id,al_titleno,al_alttitleno,al_size,al_sizeunit_id,al_landcondition_id,
				al_landposision_id,al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id,
				al_tenureperiod, al_startdate,al_expireddate, al_activeind_id,al_createby, al_createdate,al_updateby, 
				al_updatedate ) SELECT l_val_accountid,   `LO_STATE`,    `LO_DISTRICT`,   
				`LO_LOTCODE_ID`,    `LO_NO`,    `LO_ALTNO`,    `LO_TITLETYPE_ID`,    `LO_TITLENO`,    `LO_ALTTITLENO`,
				`LO_SIZE`,    `LO_SIZEUNIT_ID`,    `LO_LANDCONDITION_ID`,    `LO_LANDPOSITION_ID`,    `LO_ROADTYPE_ID`,
				`LO_ROADCATEGORY_ID`,    `LO_LANDUSE_ID`,    `LO_EXCD`,    `LO_RTIT`,    `LO_TENURETYPE_ID`,    `LO_TENUREPERIOD`,
				null,   null,    `LO_ACTIVEIND_ID`,    p_username,    now(),
				p_username,    now()  FROM `cm_lot` where LO_MA_ID =  account_id;
				
				INSERT INTO  cm_appln_bldg (`ab_vd_id`,   `ab_bldg_no`,   `ab_bldgtype_id`,   `ab_bldgstorey_id`,   `ab_bldgcondn_id`,
			   `ab_bldgposition_id`,   `ab_bldgstructure_id`,   `ab_rooftype_id`,   `ab_walltype_id`,   `ab_floortype_id`,
			   `ab_cccdate`,   `ab_occupieddate`,   `ab_ismainbldg_id`,   `ab_createby`,   `ab_createdate`,   `ab_updateby`,
			   `ab_updatedate`) SELECT  l_val_accountid,`BL_BLDG_NO`,`BL_BLDGTYPE_ID`,`BL_BLDGSTOREY_ID`,`BL_BLDGCONDN_ID`,`BL_BLDGPOSITION_ID`,
				`BL_BLDGSTRUCTURE_ID`,`BL_ROOFTYPE_ID`,`BL_WALLTYPE_ID`,`BL_FLOORTYPE_ID`,BL_CCCDATE,
				BL_OCCUPIEDDATE,`BL_ISMAINBLDG_ID`,
				p_username,    now(),    p_username,    now() from `cm_bldg` where BL_MA_ID =  account_id;	
					
				
				SELECT LAST_INSERT_ID() into l_val_bldgid;
				
				INSERT INTO `cm_appln_bldgarea` (`aba_ab_id`,`aba_ref`,`aba_areatype_id`,`aba_arealevel_id`,`aba_areacategory_id`,
				`aba_areazone_id`,`aba_areause_id`,`aba_areadesc`,`aba_dimention`,`aba_unitcount`,`aba_size`,`aba_sizeunit_id`,`aba_totsize`,
				`aba_floortype_id`,`aba_walltype_id`,`aba_ceilingtype_id`,`aba_createby`,`aba_createdate`,`aba_updateby`,`aba_updatedate`)
				select l_val_bldgid,`aba_ref`,`aba_areatype_id`,`aba_arealevel_id`,`aba_areacategory_id`,`aba_areazone_id`,
				`aba_areause_id`,`aba_areadesc`,`aba_dimention`,`aba_unitcount`,`aba_size`,`aba_sizeunit_id`,`aba_totsize`,`aba_floortype_id`,
				`aba_walltype_id`,`aba_ceilingtype_id`,p_username,    now(),    p_username,    now() from `cm_appln_bldgarea` where
				aba_ab_id in (select ab_id from cm_appln_bldg where ab_vd_id =  propertyid );
				
                insert into cm_appln_parameter (ap_vd_id, ap_bldgstatus_id, ap_propertycategory_id, 
ap_propertytype_id, ap_propertylevel_id, ap_createby, ap_createdate, ap_updateby, ap_updatedate )
	select l_val_accountid,ap_bldgstatus_id, ap_propertycategory_id, 
ap_propertytype_id, ap_propertylevel_id,p_username,    now(),    p_username,    now()  from cm_appln_parameter where ap_vd_id = propertyid;
                
                insert into cm_appln_ratepayer(arp_vd_id, arp_rp_id, arp_createby, arp_createdate,
                arp_updateby,arp_updatedate ) select l_val_accountid, arp_rp_id,p_username,    now(),    p_username,    now() from cm_appln_ratepayer where arp_vd_id= propertyid;
                
                 insert into cm_appln_tenant(at_vd_id, at_te_id, at_createby, at_createdate,
                at_updateby,at_updatedate ) select l_val_accountid, at_te_id,p_username,    now(),    p_username,    now() from cm_appln_tenant where at_vd_id = propertyid;
                
			SELECT p_newprop + 1 INTO p_newprop;
		 end if;
		 
		 END LOOP get_account;
         end;
 end if;
 CLOSE accountnumber_cursor;
 end;

 begin
 DECLARE propertyid int;
	 DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id, vd_ma_id,vd_ishasbuilding,vd_accno FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) ;
	 
	 
	

if p_type = 'deactivateproperty' then
	
begin

DECLARE hasbulding varchar(10);
	 DECLARE bldgtype varchar(10);
	 DECLARE bldgstorey varchar(10);
	 DEClARE deactivateaccountnumber_cursor CURSOR FOR SELECT vd_id,vd_ma_id,vd_ishasbuilding,vd_accno FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) ;
     
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
     DECLARE exit handler for sqlexception
	
     set p_newprop = 0;
	 OPEN accountnumber_cursor;
		set p_newprop = 0;
		 get_account: LOOP
		 
		 FETCH deactivateaccountnumber_cursor INTO propertyid, account_id, l_ishasbuilding_id,l_accno;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_appln_deactivedetl where dad_ma_id = account_id and dad_da_id = p_basket_id;
		       
         if l_count = 0 then

          
				insert into cm_appln_deactivedetl(dad_da_id,dad_ma_id,dad_accno,dad_reason_id,dad_desc) 
                values(p_basket_id, account_id,		l_accno, p_reason, p_desc);
				
				
			SELECT p_newprop + 1 INTO p_newprop;
		 end if;
		 
		 END LOOP get_account;
         CLOSE deactivateaccountnumber_cursor;
         end;
 end if;
 
 end;
 
 



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_inspectiongrap` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_inspectiongrap`(p_param TEXT,p_basket_id INT,
p_username varchar(55),p_type varchar(100),p_reason varchar(100),p_desc varchar(100), out p_newprop INT)
BEGIN
	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE v_finished2 INTEGER DEFAULT 0;
	DECLARE account_id int;
	DECLARE l_count int;
	DECLARE l_ishasbuilding_id varchar(50);
	DECLARE l_accno varchar(15);
	DECLARE l_val_accountid int;
	DECLARE l_val_bldgid int;
	DECLARE l_val_newbldgid int;
	DECLARE l_bldgtype varchar(15);
	DECLARE l_bldgcategory varchar(15);
	DECLARE l_bldgstorey varchar(15);


	if p_type = 'add' then
      begin  
	DECLARE l_va_vt_id int;
		DEClARE accountnumber_cursor CURSOR FOR SELECT ma_id,ma_ishasbuilding_id,ma_accno FROM cm_masterlist where FIND_IN_SET(ma_accno,p_param)
        and ma_approvalstatus_id = '03';
		 
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

		set p_newprop  = 0;
		 OPEN accountnumber_cursor;

		 grap_account: LOOP

		 FETCH accountnumber_cursor INTO account_id, l_ishasbuilding_id,l_accno;
		 IF v_finished = 1 THEN 
		 LEAVE grap_account;
		 END IF;

		select va_vt_id into l_va_vt_id from cm_appln_val where va_id = p_basket_id limit 1;
	 
		 select count(*) into l_count from cm_appln_valdetl 
         inner join cm_appln_val on va_id = vd_va_id
         where vd_ma_id = account_id and va_vt_id = l_va_vt_id and vd_va_id = p_basket_id;
		 
		 if l_count = 0 then
		 
				select  `BL_BLDGTYPE_ID`,`BL_BLDGSTOREY_ID` into l_bldgtype, l_bldgstorey          
				from `cm_bldg` where BL_MA_ID =  account_id and  BL_ISMAINBLDG_ID = 'Y' limit 1; 
			
				select  tdi_parent_key into l_bldgcategory         
				from `tbdefitems` where tdi_td_name =  'BULDINGTYPE' and  tdi_key = l_bldgtype; 
				
				insert into cm_appln_valdetl(vd_va_id,vd_ma_id,vd_ishasbuilding,vd_accno,vd_createby,
				vd_createdate,vd_updateby, vd_updatedate,vd_approvalstatus_id,vd_isfirsttime_id, vd_bldgtype_id, vd_bldgstorey_id) 
                values(p_basket_id, account_id,
				l_ishasbuilding_id, l_accno,p_username,now(),p_username, now(),'05','1', l_bldgtype, l_bldgstorey);
				
				SELECT LAST_INSERT_ID() into l_val_accountid;
				
				insert into cm_appln_parameter(ap_vd_id, ap_bldgstatus_id, ap_propertytype_id,ap_propertylevel_id,
				ap_propertycategory_id)
				values(l_val_accountid,l_ishasbuilding_id, l_bldgtype, l_bldgstorey, l_bldgcategory);
				
				
				insert into cm_appln_lot(al_vd_id,al_state,al_district,al_lotcode_id,al_no,
				al_altno,al_titletype_id,al_titleno,al_alttitleno,al_size,al_sizeunit_id,al_landcondition_id,
				al_landposision_id,al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id,
				al_tenureperiod, al_startdate,al_expireddate, al_activeind_id,al_createby, al_createdate,al_updateby, 
				al_updatedate ) SELECT l_val_accountid,   `LO_STATE`,    `LO_DISTRICT`,   
				`LO_LOTCODE_ID`,    `LO_NO`,    `LO_ALTNO`,    `LO_TITLETYPE_ID`,    `LO_TITLENO`,    `LO_ALTTITLENO`,
				`LO_SIZE`,    `LO_SIZEUNIT_ID`,    `LO_LANDCONDITION_ID`,    `LO_LANDPOSITION_ID`,    `LO_ROADTYPE_ID`,
				`LO_ROADCATEGORY_ID`,    `LO_LANDUSE_ID`,    `LO_EXCD`,    `LO_RTIT`,    `LO_TENURETYPE_ID`,    `LO_TENUREPERIOD`,
				null,   null,    `LO_ACTIVEIND_ID`,    p_username,    now(),
				p_username,    now()  FROM `cm_lot` where LO_MA_ID =  account_id;
				
				INSERT INTO  cm_appln_bldg (`ab_vd_id`,   `ab_bldg_no`,   `ab_bldgtype_id`,   `ab_bldgstorey_id`,   `ab_bldgcondn_id`,
			   `ab_bldgposition_id`,   `ab_bldgstructure_id`,   `ab_rooftype_id`,   `ab_walltype_id`,   `ab_floortype_id`,
			   `ab_cccdate`,   `ab_occupieddate`,   `ab_ismainbldg_id`,   `ab_createby`,   `ab_createdate`,   `ab_updateby`,
			   `ab_updatedate`) SELECT  l_val_accountid,`BL_BLDG_NO`,`BL_BLDGTYPE_ID`,`BL_BLDGSTOREY_ID`,`BL_BLDGCONDN_ID`,`BL_BLDGPOSITION_ID`,
				`BL_BLDGSTRUCTURE_ID`,`BL_ROOFTYPE_ID`,`BL_WALLTYPE_ID`,`BL_FLOORTYPE_ID`,str_to_date(`BL_CCCDATE`, '%d/%m/%Y') ,
                str_to_date(`BL_OCCUPIEDDATE`, '%d/%m/%Y') ,`BL_ISMAINBLDG_ID`,
				p_username,    now(),    p_username,    now() from `cm_bldg` where BL_MA_ID =  account_id;
				
                SELECT LAST_INSERT_ID() into l_val_newbldgid;
				
                begin
					 DECLARE bldgid int(11);
					 DECLARE v_exit INTEGER DEFAULT 0;
					 DECLARE bldgnumber varchar(255);
					 DEClARE bldg_cursor CURSOR FOR SELECT bl_id,bl_bldg_no FROM cm_bldg where bl_ma_id = account_id;
					 
					 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_exit = 1;
					
					
					 OPEN bldg_cursor;
					
					 bldg_area: LOOP
					 
						 FETCH bldg_cursor INTO bldgid, bldgnumber;
						 
						 IF v_exit = 1 THEN 
							LEAVE bldg_area;
						 END IF;
						 
						-- select ab_id into l_val_bldgid from cm_appln_bldg where ab_id = l_val_newbldgid;
                         
							 select ab_id into l_val_bldgid from cm_appln_bldg where ab_bldg_no = bldgnumber and ab_vd_id = l_val_accountid;
						 
						 INSERT INTO `cm_appln_bldgarea` (`aba_ab_id`,`aba_ref`,`aba_areatype_id`,`aba_arealevel_id`,`aba_areacategory_id`,
						`aba_areazone_id`,`aba_areause_id`,`aba_areadesc`,`aba_dimention`,`aba_unitcount`,`aba_size`,`aba_sizeunit_id`,`aba_totsize`,
						`aba_floortype_id`,`aba_walltype_id`,`aba_ceilingtype_id`,`aba_createby`,`aba_createdate`,`aba_updateby`,`aba_updatedate`)
						select l_val_bldgid,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,
						`BA_AERAUSE_ID`,`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZE`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,
						`BA_WALLTYPE_ID`,`BA_CEILINGTYPE_ID`,p_username,    now(),    p_username,    now() from `cm_bldgarea` where
						BA_BL_ID = bldgid;
						 
					 END LOOP bldg_area;
					  CLOSE bldg_cursor;
				end;
			
			
			SELECT p_newprop + 1 INTO p_newprop;
		 end if;
		 
		 END LOOP grap_account;
		CLOSE accountnumber_cursor;
	   end;
	end if;
    
    
    if p_type = 'delete' then
		begin
		 DEClARE deleteaccountnumber_cursor CURSOR FOR select vd_id from cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) and vd_va_id = p_basket_id;
		 
		 
		 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
		
	  

		OPEN deleteaccountnumber_cursor;

			 get_deleteaccount: LOOP
			 
				 FETCH deleteaccountnumber_cursor INTO l_val_accountid;

				 IF v_finished = 1 THEN 
				 LEAVE get_deleteaccount;
				 END IF;
				 
				delete from cm_appln_lot where al_vd_id = l_val_accountid;
				delete from cm_appln_valdetl where vd_id = l_val_accountid;
				delete from cm_appln_ratepayer where arp_vd_id = l_val_accountid;
				delete from cm_appln_tenant where at_vd_id = l_val_accountid;
               
				
				begin
					
					DECLARE v_exist INTEGER DEFAULT 0;
					DECLARE bldg_id INTEGER;
					DEClARE bldg_cursor CURSOR FOR select ab_id from cm_appln_bldg where  ab_vd_id =   l_val_accountid;

					DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_exist = 1;
                    OPEN bldg_cursor;
                    get_bldg: LOOP
						FETCH bldg_cursor INTO bldg_id;
						IF v_exist = 1 THEN 
							LEAVE get_bldg;
						END IF;
                        delete from cm_appln_bldgarea where aba_ab_id = bldg_id;
                    END LOOP get_bldg;
				end;
                
                delete from cm_appln_bldg where ab_vd_id = l_val_accountid;
				
			END LOOP get_deleteaccount;
			CLOSE deleteaccountnumber_cursor;
		end;
	 end if;
   
   
   if p_type = 'addexists' then
			begin
			DECLARE hasbulding varchar(10);
			 DECLARE bldgtype varchar(10);
			 DECLARE bldgstorey varchar(10);
             DECLARE propertyid int;
			 DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id,vd_ma_id,vd_ishasbuilding,vd_accno FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) ;
			 
			 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
			 DECLARE exit handler for sqlexception
			 set p_newprop = 0;
			 OPEN accountnumber_cursor;

				 get_account: LOOP
				 
				 FETCH accountnumber_cursor INTO propertyid, account_id, l_ishasbuilding_id,l_accno;
				 
				 IF v_finished = 1 THEN 
				 LEAVE get_account;
				 END IF;
				 
				 
				 select count(*) into l_count from cm_appln_valdetl where vd_ma_id = account_id and vd_va_id = p_basket_id;
				 
				 if l_count = 0 then
				 
					select ap_bldgstatus_id, ap_propertytype_id, ap_propertylevel_id into hasbulding, bldgtype, bldgstorey 
					from cm_appln_parameter where ap_vd_id = propertyid;

						insert into cm_appln_valdetl(vd_va_id,vd_ma_id,vd_ishasbuilding,vd_bldgtype_id,vd_bldgstorey_id, vd_accno,vd_createby,
						vd_createdate,vd_updateby, vd_updatedate,vd_approvalstatus_id,vd_isfirsttime_id) values(p_basket_id, account_id,
						hasbulding, bldgtype, bldgstorey, l_accno,p_username,now(),p_username, now(),'04','1');
						
						SELECT LAST_INSERT_ID() into l_val_accountid;
						
						insert into cm_appln_lot(al_vd_id,al_state,al_district,al_lotcode_id,al_no,
						al_altno,al_titletype_id,al_titleno,al_alttitleno,al_size,al_sizeunit_id,al_landcondition_id,
						al_landposision_id,al_roadtype_id, al_roadcategory_id, al_landuse_id, al_excd, al_rtit, al_tenuretype_id,
						al_tenureperiod, al_startdate,al_expireddate, al_activeind_id,al_createby, al_createdate,al_updateby, 
						al_updatedate ) SELECT l_val_accountid,   `al_state`,    `al_district`,  
						`al_lotcode_id`,    `al_no`,    `al_altno`,    `al_titletype_id`,    `al_titleno`,    `al_alttitleno`,
						`al_size`,    `al_sizeunit_id`,    `al_landcondition_id`,    `al_landposision_id`,    `al_roadtype_id`,
						`al_roadcategory_id`,    `al_landuse_id`,    `al_excd`,    `al_rtit`,    `al_tenuretype_id`,    `al_tenureperiod`,
						`al_startdate`,    `al_expireddate`,    `al_activeind_id`,    p_username,    now(),
						p_username,    now()  FROM `cm_appln_lot` where al_vd_id =  propertyid;
						
						INSERT INTO  cm_appln_bldg (`ab_vd_id`,   `ab_bldg_no`,   `ab_bldgtype_id`,   `ab_bldgstorey_id`,   `ab_bldgcondn_id`,
					   `ab_bldgposition_id`,   `ab_bldgstructure_id`,   `ab_rooftype_id`,   `ab_walltype_id`,   `ab_floortype_id`,
					   `ab_cccdate`,   `ab_occupieddate`,   `ab_ismainbldg_id`,   `ab_createby`,   `ab_createdate`,   `ab_updateby`,
					   `ab_updatedate`) SELECT  l_val_accountid,`ab_bldg_no`,`ab_bldgtype_id`,`ab_bldgstorey_id`,`ab_bldgcondn_id`,`ab_bldgposition_id`,
						`ab_bldgstructure_id`,`ab_rooftype_id`,`ab_walltype_id`,`ab_floortype_id`,`ab_cccdate`,`ab_occupieddate`,`ab_ismainbldg_id`,
						p_username,    now(),    p_username,    now() from `cm_appln_bldg` where ab_vd_id =  propertyid;
						
						SELECT LAST_INSERT_ID() into l_val_bldgid;
                        
                        

						
						INSERT INTO `cm_appln_bldgarea` (`aba_ab_id`,`aba_ref`,`aba_areatype_id`,`aba_arealevel_id`,`aba_areacategory_id`,
						`aba_areazone_id`,`aba_areause_id`,`aba_areadesc`,`aba_dimention`,`aba_unitcount`,`aba_size`,`aba_sizeunit_id`,`aba_totsize`,
						`aba_floortype_id`,`aba_walltype_id`,`aba_ceilingtype_id`,`aba_createby`,`aba_createdate`,`aba_updateby`,`aba_updatedate`)
						select l_val_bldgid,`aba_ref`,`aba_areatype_id`,`aba_arealevel_id`,`aba_areacategory_id`,`aba_areazone_id`,
						`aba_areause_id`,`aba_areadesc`,`aba_dimention`,`aba_unitcount`,`aba_size`,`aba_sizeunit_id`,`aba_totsize`,`aba_floortype_id`,
						`aba_walltype_id`,`aba_ceilingtype_id`,p_username,    now(),    p_username,    now() from `cm_appln_bldgarea` where
						aba_id in (select aba_id from cm_appln_bldg inner join cm_appln_bldgarea
            on aba_ab_id = ab_id
            where ab_vd_id =   propertyid );
						
						insert into cm_appln_parameter (ap_vd_id, ap_bldgstatus_id, ap_propertycategory_id, 
						ap_propertytype_id, ap_propertylevel_id, ap_createby, ap_createdate, ap_updateby, ap_updatedate )
							select l_val_accountid,ap_bldgstatus_id, ap_propertycategory_id, 
						ap_propertytype_id, ap_propertylevel_id,p_username,    now(),    p_username,    now()  from cm_appln_parameter where ap_vd_id = propertyid;
						
						insert into cm_appln_ratepayer(arp_vd_id, arp_rp_id, arp_createby, arp_createdate,
						arp_updateby,arp_updatedate ) select l_val_accountid, arp_rp_id,p_username,    now(),    p_username,    now() from cm_appln_ratepayer where arp_vd_id= propertyid;
						
						 insert into cm_appln_tenant(at_vd_id, at_te_id, at_createby, at_createdate,
						at_updateby,at_updatedate ) select l_val_accountid, at_te_id,p_username,    now(),    p_username,    now() from cm_appln_tenant where at_vd_id = propertyid;
						
					SELECT p_newprop + 1 INTO p_newprop;
				 end if;
				 
				 END LOOP get_account;
				 end;
		 end if;		 
	
if p_type = 'deactivateproperty' then
	
begin

DECLARE hasbulding varchar(10);
	 DECLARE bldgtype varchar(10);
	 DECLARE bldgstorey varchar(10);
	 DECLARE propertyid int;
	 DEClARE deactivateaccountnumber_cursor CURSOR FOR SELECT vd_id,vd_ma_id,vd_ishasbuilding,vd_accno FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param) ;
     
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
     DECLARE exit handler for sqlexception
	
     set p_newprop = 0;
	 OPEN deactivateaccountnumber_cursor;
		set p_newprop = 0;
		 get_account: LOOP
		 
		 FETCH deactivateaccountnumber_cursor INTO propertyid, account_id, l_ishasbuilding_id,l_accno;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_appln_deactivedetl where dad_ma_id = account_id and dad_da_id = p_basket_id;
		       
         if l_count = 0 then

          
				insert into cm_appln_deactivedetl(dad_da_id,dad_ma_id,dad_accno,dad_reason_id,dad_desc) 
                values(p_basket_id, account_id,		l_accno, p_reason, p_desc);
				
				
			SELECT p_newprop + 1 INTO p_newprop;
		 end if;
		 
		 END LOOP get_account;
         CLOSE deactivateaccountnumber_cursor;
         end;
 end if;
 
if p_type = 'editdeactivateproperty' then
	
begin

DECLARE hasbulding varchar(10);
	 DECLARE bldgtype varchar(10);
	 DECLARE bldgstorey varchar(10);
	
     update cm_appln_deactivedetl set dad_reason_id = p_reason,dad_desc = p_desc where FIND_IN_SET(dad_id,p_param) ;

         end;
 end if;
 
 if p_type = 'deletedeactivateproperty' then
	
begin


	
   delete from cm_appln_deactivedetl where FIND_IN_SET(dad_id,p_param) ;

         end;
 end if;
 
 if p_type = 'addapplication' then
	if p_param = 'add' then
		
		select count(*) into l_count from cm_officialsearch where os_vd_id = p_basket_id;
		if l_count = 0 then
			insert into cm_officialsearch(os_vd_id, os_officialsearchstatus_id, os_createby, os_createdate, os_updateby, os_updatedate)
			values(p_basket_id, '1', p_username, now(), p_username, now());
		end if;
	end if;
    
    if  p_param = 'delete' then
		delete from cm_officialsearch where os_id = p_basket_id;
    end if;
 end if;
 
 if p_type = 'addproperty' then
	if p_param = 'add' then
		-- select ma_accno into l_accno from cm_masterlist where ma_id = p_basket_id;	
			
		INSERT INTO `cm_masterlist_log` (`mal_accno`,`mal_fileno`,`mal_subzone_id`, mal_district_id,
		`mal_addr_ln1`,`mal_addr_ln2`,`mal_addr_ln3`,`mal_addr_ln4`,`mal_postcode`,`mal_city`,`mal_state_id`,
		mal_approvalstatus_id, mal_propapplntype_id,
		`mal_createby`,`mal_createdate`,
		`mal_updateby`,`mal_updatedate`)
		select ma_accno, ma_fileno,ma_subzone_id, ma_district_id,ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_postcode,
		ma_city, 
		ma_state_id, '1', '1',
		p_username, now(), p_username, now() from  cm_masterlist where ma_id = p_basket_id;	
	end if;
    
    
	if p_param = 'addlot' then
		-- select ma_accno into l_accno from cm_masterlist where ma_id = p_basket_id;	
			
		INSERT INTO `cm_lot_log` (`log_lot_id`, log_lotcode_id,
		`log_no`,`log_altno`,`log_titletype_id`,`log_titleno`,`log_alttitleno`,`log_stratano`,`log_tenuretype_id`,
        log_tenureperiod,log_startdate, log_expireddate,
		log_approvalstatus_id, 
		`log_createdby`,`log_createdate`,
		`log_updateby`,`log_updatedate`)
		select LOT_ID, LO_LOTCODE_ID,LO_NO, LO_ALTNO,LO_TITLETYPE_ID, LO_TITLENO, LO_ALTTITLENO, LO_STRATANO, LO_TENURETYPE_ID,
		LO_TENUREPERIOD, LO_STARTDATE, LO_EXPIREDDATE, '1', 
		p_username, now(), p_username, now() from  cm_lot where LO_MA_ID = p_basket_id;	
	end if;
    
 end if;
 
 if p_type = 'propertyaddressmaintenance' then
	if p_param = 'delete' then
		delete from cm_masterlist_log where mal_id = p_basket_id;
	end if;    
 end if;
 
 
 if p_type = 'addremisi' then
	if p_param = 'add' then
		-- select ma_accno into l_accno from cm_masterlist where ma_id = p_basket_id;	
			
		INSERT INTO `cm_remisi_reg` (`rg_accno`, rg_remisistatus_id,
		`rg_createby`,`rg_createat`,
		`rg_updateby`,`rg_updateat`)
		select ma_accno, '0', p_username, now(), p_username, now() from  cm_masterlist 
		inner join `cm_appln_valdetl` on`cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id` where vd_id = p_basket_id;	
	end if;
    
    
    
 end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_inspection_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_inspection_update`(
	IN `master_param` json,
	IN `lot_param` json,
	IN `bldg_param` json,
	IN `bldgar_param` json,
	IN `tenant_param` json,
	IN `ratepayer_param` json,
	IN `p_user` VARCHAR(50),
	IN `prop_id` INT,
	IN `p_basketid` INT,
	IN `attachment_param` json)
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
    DECLARE account varchar(4000) DEFAULT 0;
	DECLARE result int DEFAULT 0;
    
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
    ROLLBACK;
	END;
    
    START TRANSACTION;
	
    set account = val_master_trn(master_param,p_user,  prop_id,p_basketid);
   
    set @msg = val_lot_trn(lot_param,p_user, account,prop_id,p_basketid);
  
    set @msg = val_bldg_trn(bldg_param,p_user,   account,prop_id,p_basketid);
    
	set @msg = val_bldgarea_trn(bldgar_param,p_user,account,prop_id,p_basketid );
    
    set @msg = val_ratepayer_trn(ratepayer_param,p_user,   account,prop_id,p_basketid);
    
	set @msg = val_tenant_trn(tenant_param,p_user, account,prop_id,p_basketid );
    
    set @msg = val_parameter_trn(master_param,p_user,prop_id,p_basketid );
    
   -- set @msg = val_attachment_trn(attachment_param,p_user,prop_id,p_basketid );
    set @msg = fn_attachment(attachment_param,p_user,prop_id );
    
    set @msg = val_owner_register(master_param, p_user,'','');
    
 
	
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_manaualbldg` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_manaualbldg`(
	IN `bldgarea_param` json,
	IN `p_user` VARCHAR(50),
	IN `prop_id` INT)
BEGIN
    DECLARE i INT DEFAULT 0;
	DECLARE bldg_id int;
	DECLARE bldgar_id int;
	DECLARE l_count int;
	DECLARE arcategory varchar(55);
	DECLARE artype varchar(55);
	DECLARE aruse varchar(55);
	DECLARE arlevel varchar(55);
	DECLARE artype_id varchar(55);
	DECLARE arcategory_id varchar(55);
	DECLARE aruse_id varchar(55);
	DECLARE area float;
    
    WHILE i < JSON_LENGTH(bldgarea_param) DO
		
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(bldgarea_param,concat('$[',i,'].arcategory')))) INTO arcategory;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(bldgarea_param,concat('$[',i,'].artype')))) INTO artype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(bldgarea_param,concat('$[',i,'].aruse')))) INTO aruse;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(bldgarea_param,concat('$[',i,'].arlevel')))) INTO arlevel;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(bldgarea_param,concat('$[',i,'].area')))) INTO area;
        
		select ab_id into bldg_id from cm_appln_bldg where ab_vd_id = prop_id;
		select tdi_key into artype_id from tbdefitems where tdi_td_name = 'AREATYPE' and tdi_value = artype limit 1;   
		select tdi_key into arcategory_id from tbdefitems where tdi_td_name = 'AREACATEGORY' and tdi_value = arcategory limit 1;   
		select tdi_key into aruse_id from tbdefitems where tdi_td_name = 'AREAUSE' and tdi_value = aruse   limit 1;    
		
        select count(*) into l_count from cm_appln_bldgarea where aba_ab_id = bldg_id and
            `ABA_AREATYPE_ID` = artype_id and `ABA_AREALEVEL_ID` =arlevel and
            `ABA_AREACATEGORY_ID` = arcategory_id and `aba_areause_id` = aruse_id ;
        if area > 0 then
			if l_count = 0 then
					INSERT INTO `cm_appln_bldgarea`
					(`ABA_AB_ID`,`ABA_AREATYPE_ID`,`ABA_AREALEVEL_ID`,`ABA_AREACATEGORY_ID`,`ABA_AREAZONE_ID`,`aba_areause_id`,
					`ABA_UNITCOUNT`,`ABA_SIZEUNIT_ID`,`ABA_TOTSIZE`,`ABA_FLOORTYPE_ID`,`ABA_WALLTYPE_ID`,
					`ABA_CEILINGTYPE_ID`,`ABA_CREATEBY`,`ABA_CREATEDATE`,`ABA_UPDATEBY`,`ABA_UPDATEDATE`,ABA_SIZE)
					VALUES (bldg_id,  artype_id,  arlevel, arcategory_id, '1', aruse_id, 1, 
					'01', area, '00',
					'00', '00', p_user, now(), p_user, now(),area);
			else
          
					select ifnull(aba_id,0) into bldgar_id from cm_appln_bldgarea where aba_areatype_id =artype_id and 
aba_areacategory_id =arcategory_id and `ABA_AREALEVEL_ID` = arlevel and
aba_areause_id =aruse_id  and aba_ab_id =bldg_id;
           
					update `cm_appln_bldgarea` set aba_totsize=area,
					ABA_SIZE = area,`ABA_UPDATEBY` = p_user,`ABA_UPDATEDATE` = now() where
					ABA_ID = bldgar_id;
            
             end if;
        end if;
		SELECT i + 1 INTO i;
	END WHILE;
 
   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_manaualvaluation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_manaualvaluation`(IN `lot_param` json,
	IN `bldg_param` json,
	IN `lotarea_param` json,
	IN `additional_param` json,
	IN `bldgarea_param` json,
	IN `bldgallowance_param` json,
	IN `tax_param` json,
	IN `p_user` VARCHAR(50),
	IN `prop_id` INT)
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
	
	
   
    set @msg = manualval_lot(lot_param,p_user, prop_id);
  
    set @msg = manualval_lotarea(lotarea_param,p_user, prop_id);
    
	set @msg = manualval_bldg(bldg_param,p_user, prop_id);
    
    set @msg = manualval_bldgarea(bldgarea_param,p_user, prop_id);
 
	set @msg = manualval_additional(additional_param,p_user, prop_id);
    
    set @msg = manualval_allowance(bldgallowance_param,p_user, prop_id);
    
    set @msg = manualval_tax(tax_param,p_user, prop_id);

   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_manaualvaluation_v2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_manaualvaluation_v2`(IN `lot_param` json,
	IN `bldg_param` json,
	IN `lotarea_param` json,
	IN `additional_param` json,
	IN `bldgarea_param` json,
	IN `bldgallowance_param` json,
	IN `tax_param` json,
	IN `p_user` VARCHAR(50),
	IN `prop_id` INT)
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
	
	
   
    set @msg = manualval_lot_v2(lot_param,p_user, prop_id);
  
   /* set @msg = manualval_lotarea(lotarea_param,p_user, prop_id);
    
	set @msg = manualval_bldg(bldg_param,p_user, prop_id);
    
    set @msg = manualval_bldgarea(bldgarea_param,p_user, prop_id);
 
	set @msg = manualval_additional(additional_param,p_user, prop_id);
    
    set @msg = manualval_allowance(bldgallowance_param,p_user, prop_id);
    
    set @msg = manualval_tax(tax_param,p_user, prop_id);*/

   
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_manaual_valuation_process` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_manaual_valuation_process`(p_valuationbasket_id int, p_tonebasket_id int,
  p_tonetaxbasket_id int,  p_username varchar(50),drivedvalue float,drivedrate float,out p_result text)
BEGIN
	DECLARE l_approvestaus varchar(50);
	DECLARE l_valtype varchar(2);
	select vt_valbase_id into l_valtype from cm_appln_valterm 
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id  where vd_id = p_valuationbasket_id limit 1;
		select va_approved into l_approvestaus from cm_appln_val 
        inner join cm_appln_valdetl on vd_va_id = va_id
        where vd_id = p_valuationbasket_id;
        if l_approvestaus = '05' or l_approvestaus = '06' then
        if l_valtype = 1 then
			CALL manual_lot(p_valuationbasket_id, p_tonebasket_id, p_username);
			CALL manaual_bldg(p_valuationbasket_id, p_tonebasket_id, p_username);
			CALL manaual_tax(p_valuationbasket_id, p_tonetaxbasket_id,drivedrate,drivedvalue, p_username);
			
         end if;   
         
         if l_valtype = 2 then
			CALL manual_lot2(p_valuationbasket_id, p_tonebasket_id, p_username);
			CALL manaual_bldg2(p_valuationbasket_id, p_tonebasket_id, p_username);
			CALL manaual_tax2(p_valuationbasket_id, p_tonetaxbasket_id,drivedrate,drivedvalue, p_username);
			
		end if;  
			 update cm_appln_valdetl set vd_approvalstatus_id = '09' where vd_id = p_valuationbasket_id;
            
        end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_master` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_master`(
	IN `master_param` json,
	IN `p_user` VARCHAR(50),
	IN `basket_id` INT,
	IN `type` VARCHAR(50),
	IN `form` VARCHAR(50))
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
	DECLARE result int DEFAULT 0;
    
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
    ROLLBACK;
	END;
    
	
     START TRANSACTION;
    set @msg = pr_master_add(master_param,p_user, basket_id);
   
    
   
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_objection_agendadetail_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_objection_agendadetail_trn`(p_param TEXT,p_objection_id INT,
p_username varchar(55), out p_propcount INT, p_operation varchar(55))
BEGIN
	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE account_id int;
	DECLARE l_count int;
	DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id 
    FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param);
	 
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    
    if p_operation = 'add' then
		OPEN accountnumber_cursor;
		set p_propcount = 0;
		get_account: LOOP
		 
		FETCH accountnumber_cursor INTO account_id;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_objection_agendadetail where agd_vd_id = account_id 
         and agd_ag_id = p_objection_id;
		 
         if l_count = 0 then
		 
			
				insert into cm_objection_agendadetail(agd_ag_id,agd_vd_id,agd_createby,agd_createdate,
                agd_updateby,
				agd_updatedate) values(p_objection_id, account_id,
				p_username,now(),p_username, now());

			SELECT p_propcount + 1 INTO p_propcount;
		 end if;
		 
		 END LOOP get_account;
         
         close accountnumber_cursor;
	end if;
    
    if p_operation = 'delete' then
        select count(*) into p_propcount from cm_objection_agendadetail where FIND_IN_SET(agd_id,p_param);
		delete from cm_objection_agendadetail where FIND_IN_SET(agd_id,p_param);
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_objection_decision_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_objection_decision_trn`(p_param TEXT,
p_username varchar(55), out p_newprop INT,p_type varchar(55), objectionid int)
BEGIN
	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE account_number varchar(15);
	DECLARE l_vd_id int;
	DECLARE l_ob_id int;
	DECLARE l_count int;
	DECLARE l_approved int;
	DECLARE l_total int;
	DECLARE l_id int;
	DECLARE l_approvednt varchar(20) ;
	DECLARE l_approvedrate float;
	DECLARE l_adjustment float;
	DECLARE l_approvedtax varchar(20);
	DECLARE l_note TEXT;
	DEClARE accountnumber_cursor CURSOR FOR select vd_id, vd_accno from  cm_appln_valdetl 
     where FIND_IN_SET(vd_id,p_param);
	 
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
       if p_type = 'add' then
       OPEN accountnumber_cursor;
  set p_newprop = 0;
 get_account: LOOP
		 

		 FETCH accountnumber_cursor INTO  l_vd_id, account_number;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_objection_decision where de_vd_id = l_vd_id;
		 
       if l_count = 0 then
			insert into cm_objection_decision(de_ob_id,de_vd_id,de_accno,
			de_createby, de_createdate,
			de_updateby,
			de_updatedate) values(objectionid, l_vd_id, account_number,
			p_username,now(),p_username, now());
			
			SELECT p_newprop + 1 INTO p_newprop;
			
	 end if;
		 
		 END LOOP get_account;
         
         close accountnumber_cursor;
       end if;
       
       if p_type = 'update' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.ob_id'))) INTO l_ob_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.vd_id'))) INTO l_vd_id;
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.taxapprovednt'))) INTO l_approvednt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.taxapprovedrate'))) INTO l_approvedrate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.taxadjustment'))) INTO l_adjustment;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.taxapprovedtax'))) INTO l_approvedtax;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.taxnotes'))) INTO l_note;
    
	set l_approvednt = replace(l_approvednt, ',', '');
	set l_approvedtax = replace(l_approvedtax, ',', '');
    
       
     
       
        update cm_appln_val_tax set vt_approvednt = l_approvednt, vt_adjustment = l_adjustment,
        vt_approvedtax = l_approvedtax, vt_updateby = p_username, vt_updatedate = now(), vt_note = l_note
        where vt_vd_id = l_vd_id;
        
  
    end if;
    
     if p_type = 'delete' then
		delete from cm_objection_decision where FIND_IN_SET(de_id,p_param);
     end if;
     
     
     if p_type = 'approve' then
		update cm_appln_valdetl set vd_approvalstatus_id = '12' where vd_id = objectionid;
        select count(*) into l_approved from cm_appln_valdetl where vd_approvalstatus_id = '12' and vd_va_id in
		(select vd_va_id from cm_appln_valdetl where vd_id = objectionid);

		select count(*) into l_total from cm_appln_valdetl inner join cm_objection_decision on de_vd_id = vd_id where vd_va_id in
		(select vd_va_id from cm_appln_valdetl where vd_id = objectionid) ;
		
		if l_approved = l_total then
			update cm_appln_val set va_approved = '11' where va_id in (select vd_va_id from cm_appln_valdetl where vd_id = objectionid);
		end if;
     end if;
     
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_objection_notice_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_objection_notice_trn`(p_param TEXT,p_objection_id INT,
p_username varchar(55), out p_propcount INT, p_operation varchar(55), p_noticetype varchar(55))
BEGIN
	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE account_id int;
	DECLARE l_count int;
	DECLARE l_accno varchar(15);
	 DEClARE accountnumber_cursor CURSOR FOR SELECT vd_id, vd_accno
     FROM cm_appln_valdetl where FIND_IN_SET(vd_id,p_param);
	 
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
     if p_operation = 'add' then
 OPEN accountnumber_cursor;
 set p_propcount = 0;
 get_account: LOOP
		 
		 FETCH accountnumber_cursor INTO account_id, l_accno;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_objection_notis where no_vd_id = account_id 
         and no_ob_id = p_objection_id;
		 
         if l_count = 0 then		 
			
				insert into cm_objection_notis(no_ob_id,no_vd_id,no_accno, no_noticetype_id, no_createby,no_createdate,
                no_updateby,
				no_updatedate) values(p_objection_id, account_id, l_accno, p_noticetype,
				p_username,now(),p_username, now());
                
				SELECT p_propcount + 1 INTO p_propcount;
			
		 end if;
		 
		 END LOOP get_account;
         
         close accountnumber_cursor;
         end if;
         
   if p_operation = 'delete' then
        select count(*) into p_propcount from cm_objection_notis where FIND_IN_SET(no_id,p_param);
		delete from cm_objection_notis where FIND_IN_SET(no_id,p_param);
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_objection_objectionlist_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_objection_objectionlist_trn`(p_param TEXT,
p_username varchar(55), out p_newprop INT,p_type varchar(55), objectionid int )
BEGIN

	DECLARE v_finished INTEGER DEFAULT 0;
	DECLARE account_number varchar(15);
	DECLARE l_vd_id int;
	DECLARE ob_id int;
	DECLARE l_ol_id TEXT;
	DECLARE l_operation int;
	DECLARE id int;
	DECLARE l_count int;    
	DECLARE l_id int;
	DECLARE l_time varchar(50);
	DECLARE l_reason varchar(255);
	DECLARE l_valuerrecommend varchar(200);
    
	 DEClARE accountnumber_cursor CURSOR FOR select vd_id, vd_accno from  cm_appln_valdetl 
     where FIND_IN_SET(vd_id,p_param);
	 
	 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
       if p_type = 'add' then
 
 OPEN accountnumber_cursor;
  set p_newprop = 0;
 get_account: LOOP
		 

		 FETCH accountnumber_cursor INTO  l_vd_id, account_number;
		 
		 IF v_finished = 1 THEN 
		 LEAVE get_account;
		 END IF;
		 
		 
		 select count(*) into l_count from cm_objection_objectionlist where ol_ob_id = objectionid 
         and ol_vd_id = l_vd_id;
		 
       if l_count = 0 then
			insert into cm_objection_objectionlist(ol_ob_id,ol_vd_id,ol_accno,
			ol_createby, ol_createdate,
			ol_updateby,
			ol_updatedate) values(objectionid, l_vd_id, account_number,
			p_username,now(),p_username, now());
			
			SELECT p_newprop + 1 INTO p_newprop;
			
	 end if;
		 
		 END LOOP get_account;
         
         close accountnumber_cursor;
end if;

if  p_type = 'update' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.id'))) INTO l_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.time'))) INTO l_time;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.reason'))) INTO l_reason;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.valuerrec'))) INTO l_valuerrecommend;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.ol_id'))) INTO l_ol_id;
    if l_operation = 2 then
	update cm_objection_objectionlist set ol_time = l_time, ol_reason = l_reason, ol_valuerrecommend = l_valuerrecommend
    where ol_id = l_id;
		end if;
        
        if l_operation = 4 then
			update cm_objection_objectionlist set ol_time = l_time, ol_reason = l_reason, ol_valuerrecommend = l_valuerrecommend
    where FIND_IN_SET(ol_id,l_ol_id);
        end if;
   
end if;

if p_type = 'delete' then
        select count(*) into p_newprop from cm_objection_objectionlist where FIND_IN_SET(ol_id,p_param);
		delete from cm_objection_objectionlist where FIND_IN_SET(ol_id,p_param);
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_ownertransapplnreg_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ownertransapplnreg_trn`(
	IN `p_param` TEXT,
	IN `p_username` VARCHAR(50)
)
BEGIN 
   DECLARE l_count INT;
DECLARE p_account varchar(15);
DECLARE p_groupid varchar(30);
DECLARE p_trntype varchar(1);
DECLARE operation int;
DECLARE otarid int;
   
   SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.accountnumber')))) INTO p_account;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.group')))) INTO p_groupid;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.trntype')))) INTO p_trntype;
   SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.operation')))) INTO operation;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.id')))) INTO otarid;
   
   if operation = 1 then
	   select count(*) into l_count from cm_ownertrans_applnreg where otar_accno = p_account 
	   and otar_ownertransstatus_id in (1,2);
	   
	   if l_count = 0 then    
			insert into cm_ownertrans_applnreg(otar_accno,otar_ownertransgroup_id,otar_ownertransstatus_id,
            otar_ownertranstype_id,
			otar_createby,otar_createdate, otar_updateby, otar_updatedate) values (p_account, p_groupid, '1',p_trntype,
			p_username, now(), p_username, now());  
		end if;
    end if;
    
    if operation = 3 then
	    delete from cm_ownertrans_applnreg where otar_id=otarid;  
		
    end if;

  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_ownertransferretry_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ownertransferretry_trn`(in p_param int, in p_user varchar(100),p_status varchar(100))
BEGIN
	DECLARE res varchar(4000);
DECLARE owneraccnum varchar(15);
DECLARE ownaplntype varchar(30);
DECLARE typeofown varchar(55);
DECLARE ownnum varchar(55);
DECLARE ownname varchar(80);
DECLARE ownaddr1 varchar(150);
DECLARE ownaddr2 varchar(150);
DECLARE ownaddr3 varchar(150);
DECLARE ownaddr4 varchar(150);
DECLARE ownpostcode varchar(10);
DECLARE ownstate varchar(55);
DECLARE reasoncount varchar(55);

DECLARE addname varchar(80);
DECLARE addaddr1 varchar(150);
DECLARE addaddr2 varchar(150);
DECLARE addaddr3 varchar(150);
DECLARE addaddr4 varchar(150);
DECLARE addpostcode varchar(10);
DECLARE addstate varchar(10);
DECLARE recievedate varchar(55);
DECLARE requestdate varchar(55);
DECLARE transactionprice float;
DECLARE transactiondate varchar(55);
DECLARE refno varchar(55);
DECLARE apprefno varchar(55);
DECLARE rejectreason1 int;
DECLARE rejectreason2 int;
DECLARE rejectreason3 int;
DECLARE rejectreason4 int;
DECLARE rejectreason5 int;
DECLARE rejectreason6 int;
DECLARE l_type int;


DECLARE citizen varchar(55);
DECLARE state_id varchar(50);
DECLARE l_status varchar(50);
DECLARE l_reasonstatus varchar(50);
DECLARE telno varchar(15);
DECLARE faxno varchar(15);
DECLARE race varchar(55);
DECLARE demominator int default 0;
DECLARE race_id varchar(10);
DECLARE citizen_id varchar(10);
DECLARE owntype_id varchar(10);
DECLARE l_master_id int;
DECLARE l_count int;
DECLARE l_ownerid int default 0;
DECLARE operation int;
DECLARE transferstatus int;
DECLARE actioncode varchar(10);

  update cm_ownertrans_appln set ota_transtocenterdate = now(),ota_transtocenterby=p_user, ota_transtocenterstatus_id = 3 where ota_id = p_param;
        
       
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_ownertransferupdate_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ownertransferupdate_trn`(in p_param TEXT, in p_user varchar(100))
BEGIN
	DECLARE res varchar(4000);
	DECLARE owneraccnum varchar(15);
	DECLARE ownaplntype varchar(30);
	DECLARE typeofown varchar(55);
	DECLARE ownnum varchar(55);
	DECLARE ownname varchar(200);
	DECLARE ownaddr1 varchar(150);
	DECLARE ownaddr2 varchar(150);
	DECLARE ownaddr3 varchar(150);
	DECLARE ownaddr4 varchar(150);
	DECLARE ownpostcode varchar(10);
	DECLARE ownstate varchar(55);
	DECLARE reasoncount varchar(55);

	DECLARE addname varchar(80);
	DECLARE addaddr1 varchar(150);
	DECLARE addaddr2 varchar(150);
	DECLARE addaddr3 varchar(150);
	DECLARE addaddr4 varchar(150);
	DECLARE addpostcode varchar(10);
	DECLARE addstate varchar(10);
	DECLARE recievedate varchar(55);
	DECLARE requestdate varchar(55);
	DECLARE transactionprice float;
	DECLARE transactiondate varchar(55);
	DECLARE refno varchar(55);
	DECLARE apprefno varchar(55);
	DECLARE rejectreason1 int;
	DECLARE rejectreason2 int;
	DECLARE rejectreason3 int;
	DECLARE rejectreason4 int;
	DECLARE rejectreason5 int;
	DECLARE rejectreason6 int;
	DECLARE l_type int;


	DECLARE citizen varchar(55);
	DECLARE state_id varchar(50);
	DECLARE l_status varchar(50);
	DECLARE l_reasonstatus varchar(50);
	DECLARE telno varchar(15);
	DECLARE faxno varchar(15);
	DECLARE race varchar(55);
	DECLARE demominator int default 0;
	DECLARE race_id varchar(10);
	DECLARE citizen_id varchar(10);
	DECLARE owntype_id varchar(10);
	DECLARE l_master_id int;
	DECLARE l_count int;
	DECLARE l_ownerid int default 0;
	DECLARE operation int;
	DECLARE transferstatus int;
	DECLARE transferdate date;
	DECLARE actioncode varchar(10);
	DECLARE transstatus varchar(10);

    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.owneraccnum')))) INTO owneraccnum;
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaplntype')))) INTO ownaplntype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntypeofown')))) INTO typeofown;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownnum')))) INTO ownnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr1')))) INTO ownaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr2')))) INTO ownaddr2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr3')))) INTO ownaddr3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr4')))) INTO ownaddr4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownpostcode')))) INTO ownpostcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownstate')))) INTO ownstate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntelno')))) INTO telno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nfaxno')))) INTO faxno; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ncitizen')))) INTO citizen; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nrace')))) INTO race; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ndemominator')))) INTO demominator; 
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addname')))) INTO addname; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr1')))) INTO addaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr2')))) INTO addaddr2; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr3')))) INTO addaddr3; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr4')))) INTO addaddr4; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addpostcode')))) INTO addpostcode; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addstate')))) INTO addstate; 
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason1')))) INTO rejectreason1; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason2')))) INTO rejectreason2; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason3')))) INTO rejectreason3; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason4')))) INTO rejectreason4; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason5')))) INTO rejectreason5; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason6')))) INTO rejectreason6; 
        
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reqdate')))) INTO requestdate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addacceptdt')))) INTO recievedate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrndate')))) INTO transactiondate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrnvalue')))) INTO transactionprice; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addref')))) INTO refno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addapplicatref')))) INTO apprefno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.page')))) INTO l_type;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.readsoncount')))) INTO reasoncount;
    
	select ma_id into l_master_id from cm_masterlist where ma_accno = owneraccnum;

	if demominator = '' then 
		set  @demominator = 0;
	end if; 
    if l_type = 1 then
		-- ota_transferapplntype_id
		if reasoncount > 0 then
			set transstatus = 3;
			
		else
			set transstatus = 2;
		end if;
		insert into cm_ownertrans_appln(`ota_transferapplntype_id`,`ota_transferapplntypestatus_id`,
			`ota_owntype_id`,`ota_ownno`,`ota_ownname`,`ota_addr_ln1`,`ota_addr_ln2`,`ota_addr_ln3`,
			`ota_addr_ln4`,`ota_postcode`,`ota_state_id`,`ota_citizen_id`,`ota_race_id`,`ota_phoneno`,
			`ota_denomtr`,`ota_agentname`,`ota_agentaddr_ln1`,`ota_agentaddr_ln2`,`ota_agentaddr_ln3`,
			`ota_agentaddr_ln4`,`ota_agentpostcode`,`ota_agentstate_id`,
			`ota_applydate`,`ota_recievedate`,`ota_transactionprice`,`ota_transactiondate`,`ota_agentrefno`,
			`ota_createby`,`ota_createdate`,
			`ota_updateby`,`ota_updatedate`,`ota_rejectreason1`,`ota_rejectreason2`,`ota_rejectreason3`,`ota_rejectreason4`
			,`ota_rejectreason5`,`ota_rejectreason6`,ota_transtocenterstatus_id)
			VALUES (1, 2, typeofown, ownnum, ownname, ownaddr1, ownaddr2, ownaddr3, ownaddr4, ownpostcode, ownstate,
			citizen, race, telno, demominator,addname, addaddr1, addaddr2 , addaddr3, addaddr4, addpostcode, addstate,
			 ifnull(null,DATE_FORMAT(STR_TO_DATE(requestdate, '%d/%m/%Y'), '%Y-%m-%d')), ifnull(null,DATE_FORMAT(STR_TO_DATE(recievedate, '%d/%m/%Y'), '%Y-%m-%d')),
			 transactionprice, ifnull(null,DATE_FORMAT(STR_TO_DATE(transactiondate, '%d/%m/%Y'), '%Y-%m-%d')), refno,  p_user,
			 now(), p_user, now(),rejectreason1,rejectreason2,rejectreason3,rejectreason4,rejectreason5,rejectreason6,transstatus);
             
		/*update cm_ownertrans_applnreg set otar_ownertransstatus_id = transstatus, otar_updateby = p_user,
		otar_updatedate = now() where otar_accno = owneraccnum;*/
		
	   
			   
		update cm_owner set  `TO_OWNERAPPLNTYPE_ID` = ownaplntype,`TO_OWNTYPE_ID` = typeofown,
		`TO_OWNNO` = ownnum,`TO_OWNNAME` = ownname,`TO_ADDR_LN1` = ownaddr1,`TO_ADDR_LN2` = ownaddr2,
		`TO_ADDR_LN3` = ownaddr3,`TO_ADDR_LN4` = ownaddr4,`TO_POSTCODE` = ownpostcode,`TO_STATE_ID` = ownstate,
		`TO_CITIZEN_ID` = citizen,`TO_RACE_ID` = race,`TO_DENOMTR` = demominator,
		`TO_UPDATEBY` = p_user,`TO_UPDATEDATE` = now(), TO_TELNO = telno,TO_FAXNO = faxno
		WHERE `TO_MA_ID` = l_master_id;
	end if;
    
    if l_type = 2 then
		
        insert into cm_ownertrans_applnreg(otar_accno,otar_ownertransgroup_id,otar_ownertransstatus_id,
            otar_ownertranstype_id,
			otar_createby,otar_createdate, otar_updateby, otar_updatedate) values (owneraccnum, '', '1','3',
			p_user, now(), p_user, now());  
            
        insert into cm_ownertrans_appln(`ota_transferapplntype_id`,`ota_transferapplntypestatus_id`,
		`ota_owntype_id`,`ota_ownno`,`ota_ownname`,`ota_addr_ln1`,`ota_addr_ln2`,`ota_addr_ln3`,
		`ota_addr_ln4`,`ota_postcode`,`ota_state_id`,`ota_citizen_id`,`ota_race_id`,`ota_phoneno`,
		`ota_denomtr`,`ota_agentname`,`ota_agentaddr_ln1`,`ota_agentaddr_ln2`,`ota_agentaddr_ln3`,
		`ota_agentaddr_ln4`,`ota_agentpostcode`,`ota_agentstate_id`,
		`ota_createby`,`ota_createdate`,
		`ota_updateby`,`ota_updatedate`)
		VALUES (3, 2, typeofown, ownnum, ownname, ownaddr1, ownaddr2, ownaddr3, ownaddr4, ownpostcode, ownstate,
		citizen, race, telno, demominator,addname, addaddr1, addaddr2 , addaddr3, addaddr4, addpostcode, addstate,   p_user,
			 now(), p_user, now());
             
		update cm_owner set  `TO_OWNERAPPLNTYPE_ID` = ownaplntype,`TO_OWNTYPE_ID` = typeofown,
		`TO_OWNNO` = ownnum,`TO_OWNNAME` = ownname,`TO_ADDR_LN1` = ownaddr1,`TO_ADDR_LN2` = ownaddr2,
		`TO_ADDR_LN3` = ownaddr3,`TO_ADDR_LN4` = ownaddr4,`TO_POSTCODE` = ownpostcode,`TO_STATE_ID` = ownstate,
		`TO_CITIZEN_ID` = citizen,`TO_RACE_ID` = race,`TO_DENOMTR` = demominator,
		`TO_UPDATEBY` = p_user,`TO_UPDATEDATE` = now(), TO_TELNO = telno,TO_FAXNO = faxno
		WHERE `TO_MA_ID` = l_master_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_ownertransfer_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ownertransfer_trn`(in p_param TEXT, in p_user varchar(100),p_status varchar(100))
BEGIN
	DECLARE res varchar(4000);
	DECLARE owneraccnum varchar(15);
	DECLARE ownaplntype varchar(30);
	DECLARE typeofown varchar(55);
	DECLARE ownnum varchar(55);
	DECLARE ownname varchar(80);
	DECLARE ownaddr1 varchar(150);
	DECLARE ownaddr2 varchar(150);
	DECLARE ownaddr3 varchar(150);
	DECLARE ownaddr4 varchar(150);
	DECLARE ownpostcode varchar(10);
	DECLARE ownstate varchar(55);
	DECLARE reasoncount varchar(55);

	DECLARE addname varchar(80);
	DECLARE addaddr1 varchar(150);
	DECLARE addaddr2 varchar(150);
	DECLARE addaddr3 varchar(150);
	DECLARE addaddr4 varchar(150);
	DECLARE addpostcode varchar(10);
	DECLARE addstate varchar(10);
	DECLARE recievedate varchar(55);
	DECLARE requestdate varchar(55);
	DECLARE transactionprice float;
	DECLARE transactiondate varchar(55);
	DECLARE refno varchar(55);
	DECLARE apprefno varchar(55);
	DECLARE rejectreason1 int;
	DECLARE rejectreason2 int;
	DECLARE rejectreason3 int;
	DECLARE rejectreason4 int;
	DECLARE rejectreason5 int;
	DECLARE rejectreason6 int;
	DECLARE l_type int;


	DECLARE citizen varchar(55);
	DECLARE state_id varchar(50);
	DECLARE l_status varchar(50);
	DECLARE l_reasonstatus varchar(50);
	DECLARE telno varchar(15);
	DECLARE faxno varchar(15);
	DECLARE race varchar(55);
	DECLARE demominator int default 0;
	DECLARE race_id varchar(10);
	DECLARE citizen_id varchar(10);
	DECLARE owntype_id varchar(10);
	DECLARE l_master_id int;
	DECLARE l_count int;
	DECLARE l_ownerid int default 0;
	DECLARE operation int;
	DECLARE transferstatus int;
	DECLARE transferdate date;
	DECLARE actioncode varchar(10);

    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.owneraccnum')))) INTO owneraccnum;
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaplntype')))) INTO ownaplntype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntypeofown')))) INTO typeofown;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownnum')))) INTO ownnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownname')))) INTO ownname;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr1')))) INTO ownaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr2')))) INTO ownaddr2;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr3')))) INTO ownaddr3;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownaddr4')))) INTO ownaddr4;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownpostcode')))) INTO ownpostcode;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nownstate')))) INTO ownstate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ntelno')))) INTO telno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nfaxno')))) INTO faxno; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ncitizen')))) INTO citizen; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.nrace')))) INTO race; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ndemominator')))) INTO demominator; 
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addname')))) INTO addname; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr1')))) INTO addaddr1;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr2')))) INTO addaddr2; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr3')))) INTO addaddr3; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addaddr4')))) INTO addaddr4; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addpostcode')))) INTO addpostcode; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addstate')))) INTO addstate; 
    
    
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason1')))) INTO rejectreason1; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason2')))) INTO rejectreason2; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason3')))) INTO rejectreason3; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason4')))) INTO rejectreason4; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason5')))) INTO rejectreason5; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reason6')))) INTO rejectreason6; 
        
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reqdate')))) INTO requestdate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addacceptdt')))) INTO recievedate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrndate')))) INTO transactiondate; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addtrnvalue')))) INTO transactionprice; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addref')))) INTO refno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.addapplicatref')))) INTO apprefno;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.page')))) INTO l_type;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.reasoncount')))) INTO reasoncount;
    
  if l_type = 1 then
	if reasoncount > 0 then
		set l_reasonstatus = 2;
		update cm_ownertrans_applnreg set otar_ownertransstatus_id = 9, otar_updateby = p_user,otar_updatedate = now()  where otar_accno = owneraccnum;
   else    
		if p_status = 'ST' then
				update cm_ownertrans_applnreg set otar_ownertransstatus_id = 7, otar_updateby = p_user,otar_updatedate = now()  where otar_accno = owneraccnum;
           end if;
		   if p_status = 'FT' then
				update cm_ownertrans_applnreg set otar_ownertransstatus_id = 8, otar_updateby = p_user,otar_updatedate = now() where otar_accno = owneraccnum;
           end if;
         
		   if p_status = 'NT' then
				update cm_ownertrans_applnreg set otar_ownertransstatus_id = 9, otar_updateby = p_user,otar_updatedate = now() where otar_accno = owneraccnum;
           end if;   
	       set l_reasonstatus = 1;
      end if;
  end if;
    
		 select ma_id into l_master_id from cm_masterlist where ma_accno = owneraccnum;

		   if demominator = '' then 
			set  @demominator = 0;
		   end if; 
		   if p_status = 'ST' then
				set transferstatus = 3;
				set transferdate = now();
           end if;
           if reasoncount > 0 then
			  
					set transferstatus = 9;
					set transferdate = null;
			  
           else
               if p_status = 'FT' then
					set transferstatus = 8;
					set transferdate = now();
			   end if;
               if p_status = 'NT' then
					set transferstatus = 9;
					set transferdate = null;
			   end if;
            end if;
		update cm_owner set  `TO_OWNERAPPLNTYPE_ID` = ownaplntype,`TO_OWNTYPE_ID` = typeofown,
		`TO_OWNNO` = ownnum,`TO_OWNNAME` = ownname,`TO_ADDR_LN1` = ownaddr1,`TO_ADDR_LN2` = ownaddr2,
		`TO_ADDR_LN3` = ownaddr3,`TO_ADDR_LN4` = ownaddr4,`TO_POSTCODE` = ownpostcode,`TO_STATE_ID` = ownstate,
		`TO_CITIZEN_ID` = citizen,`TO_RACE_ID` = race,`TO_DENOMTR` = demominator,
		`TO_UPDATEBY` = p_user,`TO_UPDATEDATE` = now(), TO_TELNO = telno,TO_FAXNO = faxno
		WHERE `TO_MA_ID` = l_master_id;
        
        insert into cm_ownertrans_appln(`ota_transferapplntype_id`,`ota_transferapplntypestatus_id`,
		`ota_owntype_id`,`ota_ownno`,`ota_ownname`,`ota_addr_ln1`,`ota_addr_ln2`,`ota_addr_ln3`,
		`ota_addr_ln4`,`ota_postcode`,`ota_state_id`,`ota_citizen_id`,`ota_race_id`,`ota_phoneno`,
		`ota_denomtr`,`ota_agentname`,`ota_agentaddr_ln1`,`ota_agentaddr_ln2`,`ota_agentaddr_ln3`,
		`ota_agentaddr_ln4`,`ota_agentpostcode`,`ota_agentstate_id`,
		`ota_applydate`,`ota_recievedate`,`ota_transactionprice`,`ota_transactiondate`,`ota_agentrefno`,`ota_transtocenterstatus_id`,
		`ota_createby`,`ota_createdate`,
		`ota_updateby`,`ota_updatedate`,`ota_rejectreason1`,`ota_rejectreason2`,`ota_rejectreason3`,`ota_rejectreason4`
        ,`ota_rejectreason5`,`ota_rejectreason6`,`ota_transtocenterdate`)
		VALUES (l_type, l_reasonstatus, typeofown, ownnum, ownname, ownaddr1, ownaddr2, ownaddr3, ownaddr4, ownpostcode, ownstate,
		citizen, race, telno, demominator,addname, addaddr1, addaddr2 , addaddr3, addaddr4, addpostcode, addstate,
		 ifnull(null,DATE_FORMAT(STR_TO_DATE(requestdate, '%d/%m/%Y'), '%Y-%m-%d')), ifnull(null,DATE_FORMAT(STR_TO_DATE(recievedate, '%d/%m/%Y'), '%Y-%m-%d')),
		 transactionprice, ifnull(null,DATE_FORMAT(STR_TO_DATE(transactiondate, '%d/%m/%Y'), '%Y-%m-%d')), refno,  transferstatus, p_user,
         now(), p_user, now(),rejectreason1,rejectreason2,rejectreason3,rejectreason4,rejectreason5,rejectreason6 , transferdate);
				
	
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_property_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_property_register`(
	IN `master_param` json,
	IN `lot_param` json,
	IN `owner_param` json,
	IN `bldg_param` json,
	IN `bldgar_param` json,
	IN `p_user` VARCHAR(50),
	IN `basket_id` INT,
	IN `type` VARCHAR(50),
	IN `form` VARCHAR(50)
)
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
	DECLARE result int DEFAULT 0;   
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
    ROLLBACK;
	END;   	
    
    START TRANSACTION;
    
	set @msg = pr_master_add(master_param,p_user, basket_id,'');
    set @result = pr_lot_register(lot_param, p_user,'','');
    set @result = pr_owner_register(owner_param, p_user,'','');
    set @result = pr_bldg_register(bldg_param, p_user,'','');
    set @result = pr_bldg_area_register(bldgar_param, p_user,'','');
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_propreg_single` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_propreg_single`(
	IN `master_param` json,
	IN `lot_param` json,
	IN `owner_param` json,
	IN `bldg_param` json,
	IN `bldgar_param` json,
	IN `p_user` VARCHAR(50),
	IN `basket_id` INT,
	IN `type` VARCHAR(50),
	IN `form` VARCHAR(50))
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
    DECLARE account varchar(4000) DEFAULT 0;
	DECLARE result int DEFAULT 0;
    
    
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
    ROLLBACK;
	END;
    
     START TRANSACTION;
     
    set account = pr_master_add(master_param,p_user, basket_id, type);
  -- select account;
    set @msg = pr_owner_register(owner_param,p_user, type, account);
   
    set @msg = pr_lot_register(lot_param,p_user, type, account);
  
    set @msg = pr_bldg_register(bldg_param,p_user,  type, account);
    
  if bldgar_param <> '' then
    set @msg = pr_bldg_area_register_tab(bldgar_param,p_user,type, account );
  end if;
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_pr_master_table` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_pr_master_table`(in p_param json)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE accountnumber varchar(15);
WHILE i < JSON_LENGTH(p_param) DO
    SELECT JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')) INTO accountnumber;
    SELECT product;
    SELECT i + 1 INTO i;
END WHILE;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_borangc` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_borangc`(in p_termid int,in p_ratepayer varchar(255),in p_ratepayertype varchar(255))
BEGIN
DECLARE l_termdate date;
if p_ratepayer = '' then
set p_ratepayer = null;
end if;
select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

select l_termdate vt_termDate , te_name, sum(1) bldgcount,sum(vt_approvednt) vt_approvednt, max(vt_approvedrate) vt_approvedrate, 
sum(vt_approvedtax ) vt_approvedtax
from cm_appln_tenant 
inner join cm_tenant on at_te_id = te_id
inner join cm_appln_valdetl on at_vd_id = vd_id
inner join cm_appln_val on vd_va_id = va_id
inner join cm_appln_valterm on va_vt_id = vt_id
inner join cm_appln_val_tax on vd_id = vt_vd_id
inner join  cm_appln_ratepayer  on vd_id = ARP_VD_ID
inner join cm_ratepayer  on ARP_RP_ID = rp_id
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
 where vt_termDate <= l_termdate and te_id = ifnull(p_ratepayer,te_id) and rp_type_id = p_ratepayertype
group by vt_termDate, te_name;
 drop table if exists temp1; 
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_collection_zoneandbldgcategory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_collection_zoneandbldgcategory`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

 
 SELECT ma_subzone_id, `subzone`.`tdi_value` subzone, buildingtype.tdi_parent_name bldgcategory, count(vd_id) propcount,
sum(`vt_approvednt`) vt_approvednt, sum(`vt_approvedtax`)  vt_approvedtax FROM `cm_appln_valdetl`
inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `tbdefitems` subzone ON `cm_masterlist`.`ma_subzone_id` = `subzone`.`tdi_key` and subzone.tdi_td_name = "SUBZONE"
INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
 and buildingtype.tdi_td_name = "BULDINGTYPE"
 where vt_termDate <= l_termdate
group by subzone.tdi_value, buildingtype.tdi_parent_name   order by subzone.tdi_parent_name, subzone.tdi_value, buildingtype.tdi_parent_name ASC;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_export` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_export`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

		select ma_accno, subzone.tdi_parent_key , bldgstorey.tdi_value bldgstorey, subzone.tdi_parent_name zone, subzone.tdi_value subzone, subzone.tdi_key, vt_termDate,
		bldgstatus.tdi_value bldgstatus, bldgstatus.tdi_key, proptype.tdi_parent_name bldgcategory, proptype.tdi_value bldgtype,
		 vt_approvednt, vt_approvedrate, vt_proposednt,
		vt_proposedrate, ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_postcode, propstate.tdi_value, to_addr_ln1,to_addr_ln2,
		to_addr_ln3, to_addr_ln4, to_postcode, ownstate.tdi_value
         from cm_appln_valterm 
        inner join cm_appln_val on va_vt_id = cm_appln_valterm.vt_id
        inner join cm_appln_valdetl on vd_va_id = va_id
        inner join cm_masterlist on ma_id = vd_ma_id
		inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        inner join cm_owner on to_ma_id = cm_masterlist.ma_id
        inner join cm_appln_lot on al_vd_id = vd_id
        left join tbdefitems  subzone
        on subzone.`tdi_key` = ma_subzone_id and  subzone.tdi_td_name = "SUBZONE"
        left join tbdefitems proptype
        on proptype.tdi_key = vd_bldgtype_id and proptype.tdi_td_name = "BULDINGTYPE"
        left join tbdefitems bldgstatus
        on bldgstatus.tdi_key = vd_ishasbuilding and bldgstatus.tdi_td_name = "ISHASBUILDING"
		left join tbdefitems bldgstorey
		on bldgstorey.tdi_key = vd_bldgstorey_id and bldgstorey.tdi_td_name = "BUILDINGSTOREY"
        left join tbdefitems propstate
        on propstate.tdi_key = ma_state_id and propstate.tdi_td_name = "STATE"
        left join tbdefitems ownstate
        on ownstate.tdi_key = TO_STATE_ID and ownstate.tdi_td_name = "STATE"
		where vt_termDate <= l_termdate;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_summary_district` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_district`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

 
 select 
`ma_district_id` `district_id`, buildingstatus.tdi_value bldgcategory, `district`.`tdi_value` district, count(vd_id) propcount,
sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `tbdefitems` buildingstatus ON `cm_appln_valdetl`.`vd_ishasbuilding` = `buildingstatus`.`tdi_key`
 and buildingstatus.tdi_td_name = "ISHASBUILDING"
INNER JOIN `tbdefitems` district ON `cm_masterlist`.`ma_district_id` = `district`.`tdi_key` and district.tdi_td_name = 'DISTRICT'
 where vt_termDate <= l_termdate
group by ma_district_id, buildingstatus.tdi_value order by buildingstatus.tdi_value;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_summary_racepropstatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_racepropstatus`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);


SET @sql = NULL;
SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(
      'count(case when race.tdi_value = ''',
      race.tdi_value,
      ''' then 1 end) AS ',
      replace(race.tdi_value, '-', '')
    )
  ) INTO @sql
from tbdefitems race where   race.tdi_td_name = "RACE";



SET @sqlquery = CONCAT('select 
`tbdefitems_ishasbuilding`.`tdi_value` `bldgstatus`, tbdefitems_bldgtype.tdi_parent_name bldgcategory,   ', @sql, ', sum(1) TOTAL 
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN cm_owner ON TO_MA_ID = MA_ID 
INNER JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
INNER JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
INNER JOIN `tbdefitems` race ON `race`.`tdi_key` = `cm_owner`.`to_race_id`  and race.tdi_td_name = "RACE"
where vt_termDate <= "',l_termdate ,'"
group by `tbdefitems_ishasbuilding`.`tdi_value`, tbdefitems_bldgtype.tdi_parent_name');
 PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_summary_subzone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_subzone`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;
 
 DROP table IF EXISTS mytempAA;
 
CREATE TEMPORARY TABLE mytempAA select vd_ma_id, vt_termDate from cm_appln_valterm
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id  where vt_termDate <= l_termdate;


CREATE TEMPORARY TABLE mytempA select * from mytempAA
where vd_ma_id not in ( select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate) ;

CREATE TEMPORARY TABLE mytempBB
select vd_ma_id, count(vd_ma_id) billS from cm_appln_valterm
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id
where vt_termDate <= l_termdate
GROUP BY vd_ma_id;

CREATE TEMPORARY TABLE mytempB
SELECT     vd_ma_id, MAX(vt_termDate) AS vt_termDate
		FROM         mytempA
		GROUP BY vd_ma_id;
        
CREATE TEMPORARY TABLE mytempC
SELECT     mytempB.vd_ma_id, mytempB.vt_termDate, mytempBB.billS
		FROM         mytempB INNER JOIN
                      mytempBB ON mytempB.vd_ma_id = mytempBB.vd_ma_id;

CREATE TEMPORARY TABLE mytempD
select vd_id, vd_ma_id, vt_termDate from cm_appln_valterm
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id
where vt_termDate <= l_termdate;
                 
                 
CREATE TEMPORARY TABLE mytempE
SELECT     mytempD.vd_id,mytempD.vd_ma_id, mytempD.vt_termDate,  mytempC.billS 
FROM         mytempD INNER JOIN
mytempC ON mytempD.vd_ma_id = mytempC.vd_ma_id AND mytempD.vt_termDate = mytempC.vt_termDate INNER JOIN
mytempB ON mytempC.vd_ma_id = mytempB.vd_ma_id AND mytempC.vt_termDate = mytempB.vt_termDate;

select * from mytempE;

drop table mytempAA;
		drop table mytempA;
		drop table mytempBB;
		drop table mytempB;
		drop table mytempC;
		drop table mytempD;
		drop table mytempE;
		drop table mytempF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_summary_zone` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_zone`(in p_termid int, p_param text)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);
set l_filtercon = "";
if p_param <> '' then
	set l_filtercon = concat(' and ', p_param);
end if;

 

SET @sqlquery = CONCAT(' select ma_subzone_id,
`tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_key` `subzone_id`, `tbdefitems_subzone`.`tdi_value` `subzone`, count(vd_id) propcount,
sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
INNER JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
 where vt_termDate <= "',l_termdate,'" ', l_filtercon ,'
group by `tbdefitems_subzone`.`tdi_value` order by `tbdefitems_subzone`.`tdi_parent_name`');

PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_repo_summary_zonepropstatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_zonepropstatus`(in p_termid int, p_param text)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

set l_filtercon = "";
if p_param <> '' then
	set l_filtercon = concat(' and ', p_param);
end if;

SET @sql = NULL;
SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(
      'count(case when buildingtype.tdi_parent_name = ''',
      buildingtype.tdi_parent_name,
      ''' then 1 end) AS ',
      replace(buildingtype.tdi_parent_name, ' ', '')
    )
  ) INTO @sql
from tbdefitems buildingtype where buildingtype.tdi_td_name = "BULDINGTYPE";

SET @sqlquery = CONCAT('SELECT subzone.tdi_parent_name zone, subzone.tdi_key subzoneid, `subzone`.`tdi_value` suzbone, buildingstatus.tdi_value bldgcategory, ', @sql ,', sum(1) TOTAL FROM `cm_appln_valdetl`
inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `tbdefitems` subzone ON `cm_masterlist`.`ma_subzone_id` = `subzone`.`tdi_key` and subzone.tdi_td_name = "SUBZONE"
INNER JOIN `tbdefitems` buildingstatus ON `cm_appln_valdetl`.`vd_ishasbuilding` = `buildingstatus`.`tdi_key`
 and buildingstatus.tdi_td_name = "ISHASBUILDING"
INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
 and buildingtype.tdi_td_name = "BULDINGTYPE"
 where vt_termDate <= "',l_termdate ,'" ', l_filtercon ,' 
group by subzone.tdi_key, subzone.tdi_value, buildingstatus.tdi_value, subzone.tdi_parent_name   order by `subzone`.`tdi_key` ASC');

PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_resetmass` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_resetmass`(p_basketid int,p_type varchar(5))
BEGIN
	DECLARE propid int DEFAULT 0;
    if p_type = 'B' then
		delete from `cm_appln_val_additional` where vad_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid) ;
		
		
		delete from `cm_appln_val_bldgallowances` where vbal_vb_id in (select vb_id from cm_appln_val_bldg where vb_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid));
		delete from `cm_appln_val_bldgarea` where vba_vb_id in (select vb_id from cm_appln_val_bldg where vb_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid));
		delete from `cm_appln_val_bldg` where vb_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid) ;
		
	   
		delete from `cm_appln_val_lotarea` where vla_vt_id in (select vl_id from `cm_appln_val_lot` where vl_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid));
		 delete from `cm_appln_val_lot` where vl_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid) ;
		
		delete from `cm_appln_val_tax` where vt_vd_id in (select vd_id from cm_appln_valdetl where vd_va_id = p_basketid) ;
	   
		update cm_appln_val set va_approvalstatus_id = '06' where  va_id = p_basketid;
		update cm_appln_valdetl set vd_approvalstatus_id = '07' where  vd_va_id = p_basketid;
    
    end if;
    
    if p_type = 'I' then
		delete from `cm_appln_val_additional` where vad_vd_id = p_basketid;
        
    
		
		delete from `cm_appln_val_bldgallowances` where vbal_vb_id = p_basketid;
		delete from `cm_appln_val_bldgarea` where vba_vb_id = p_basketid;
		delete from `cm_appln_val_bldg` where vb_vd_id = p_basketid;
		
	   
		delete from `cm_appln_val_lotarea` where vla_vt_id in (select vl_id from `cm_appln_val_lot` where vl_vd_id = p_basketid);
		 delete from `cm_appln_val_lot` where vl_vd_id = p_basketid;
		
		delete from `cm_appln_val_tax` where vt_vd_id = p_basketid;
	   
    
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_taxtransfer` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_taxtransfer`(p_termid int, p_username varchar(50))
BEGIN
	insert into tbtaxinterface(txi_accno,txi_vd_id,txi_vt_id,txi_termdate,txi_proposent,txi_proposerate,txi_calculatedrate, 
	txi_proposetax,txi_finalnt,txi_finalrate,txi_adjustment,txi_finaltax,txi_entrytype_id,txi_entrycount,txi_txistatus_id) 
	select vd_accno, vd_id, cm_appln_valterm.vt_id,  vt_termDate, vt_proposednt, vt_proposedrate, vt_calculatedrate, vt_proposedtax, vt_approvednt, vt_approvedrate,
	 vt_adjustment, vt_approvedtax, '0', 0, '0' from cm_appln_valterm 
	inner join cm_appln_val on va_vt_id = cm_appln_valterm.vt_id 
	inner join cm_appln_valdetl on vd_va_id = va_id
	inner join cm_appln_val_tax on vt_vd_id = vd_id
	where cm_appln_valterm.vt_id = p_termid;
    
    update cm_appln_valterm set vt_approvalstatus_id = '04', vt_approvalstatusby = p_username, vt_approvalstatusdate = now() where vt_id = p_termid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbaccess_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbaccess_trn`(in p_module_id double,in p_role_id varchar(4000),
      in p_readonly double, in p_hide double,in p_operation double,in p_access_id double)
BEGIN
 DECLARE NOT_FOUND INT DEFAULT 0;
      DECLARE l_access_id bigint;
      DECLARE l_role_id bigint;
      DECLARE f_access_id bigint;
      DECLARE l_count bigint;
      DECLARE role_query varchar(255);
      DECLARE role_cur CURSOR for select rol_id from tbrole where FIND_IN_SET(rol_id, p_role_id);
      DECLARE CONTINUE HANDLER FOR NOT FOUND SET NOT_FOUND = 1; 
select rol_id from tbrole where FIND_IN_SET(rol_id, p_role_id);
    
    open role_cur;
    if p_operation = 1 then            
    
        delete from tbaccess where acc_module_id = p_module_id;
    
       
   
        loop_label:
        loop
        
        
           fetch role_cur into l_role_id;          
           
           select count(acc_id) into l_count from tbaccess where acc_module_id = p_module_id and acc_role_id =l_role_id;
           
            if l_count = 0 then
            
                insert into tbaccess( acc_module_id,acc_role_id,acc_isreadonly,acc_ishide) 
                values (p_module_id,l_role_id,p_readonly, p_hide); 
             
            end if;
            
            
            
            
            
        
        
        
        IF NOT_FOUND = 1 THEN LEAVE loop_label; END IF;
       end loop;
       
    end if;

    if p_operation = 2 then       
        
            fetch role_cur into l_role_id;
            insert into tbaccess( acc_id,acc_module_id,acc_role_id,acc_isreadonly,acc_ishide) 
            values (l_access_id,p_module_id,l_role_id,p_readonly, p_hide);  
            
        
        
        
    end if;

    
       
    
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbdefitems_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbdefitems_trn`(in p_td_name varchar(155),in p_key varchar(50),
      in p_value varchar(50),in p_desc varchar(50),in p_parent_key varchar(50),
      in p_sort int, in p_user varchar(155),in p_operation int)
BEGIN
	
	DECLARE l_parent_name varchar(150);
	DECLARE l_parent_key varchar(150);
	DECLARE l_parent varchar(150);
	DECLARE l_count int;
	if p_operation = 1 then
		select pd_parent into l_parent from  tbpardef where pd_name = p_td_name limit 1;
        if l_parent <> 'Root' then
			select  tdi_value into l_parent_name from tbdefitems where tdi_key = p_parent_key and tdi_td_name
            = l_parent  limit 1; 
        end if;
		
		select count(*) into l_count from tbdefitems where tdi_td_name = p_td_name and tdi_key = p_key and tdi_parent_key = p_parent_key;
		if l_count = 0 then
			INSERT INTO `tbdefitems`(`tdi_td_name`,`tdi_key`,`tdi_value`,`tdi_parent_name`,`tdi_parent_key`,
			`tdi_desc`,`tdi_sort`,`tdi_createby`,`tdicreateat`,`tdi_updateby`,`tdi_updateat`)
			VALUES (p_td_name,p_key,p_value,l_parent_name,p_parent_key,p_desc,p_sort,p_user,now(),p_user,now());
        end if;       
    end if;
    
	if p_operation = 2 then
		select pd_parent into l_parent from  tbpardef where pd_name = p_td_name;
        if l_parent <> 'Root' then
			select  tdi_value into l_parent_name from tbdefitems where tdi_key = p_parent_key and tdi_td_name
            = l_parent; 
        end if;
		UPDATE `tbdefitems` SET `tdi_value` = p_value,`tdi_parent_name` = l_parent_name,`tdi_parent_key` = p_parent_key,
		`tdi_desc`=p_desc,`tdi_sort`=p_sort,`tdi_updateby` = p_user,`tdi_updateat` = now()
		WHERE `tdi_td_name` = p_td_name and `tdi_key` = p_key; 
    end if;
    
    if p_operation = 3 then
		DELETE FROM `tbdefitems` WHERE `tdi_td_name` = p_td_name and `tdi_key` = p_key;  
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbmodule_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbmodule_trn`(in p_name varchar(100),in p_description varchar(155),
      in p_parent double, in p_permission double,in p_operation double,in p_module_id double)
BEGIN
      DECLARE l_tbmodule_id bigint;
   
    if p_operation = 1 then            
        
        
        
            insert into tbmodule( mod_id,mod_name,mod_description,mod_parent,mod_iscanselect) 
            values (p_module_id,p_name,p_description,p_parent, p_permission);  
            
        
        
        
        
    end if;

    if p_operation = 2 then
       update tbmodule set mod_name = p_name,mod_description = p_description,
       mod_parent = p_parent,mod_iscanselect = p_permission
       where mod_id = p_module_id;   
    end if;

    if p_operation = 3 then
        delete from tbmodule where  mod_id = p_module_id;
    end if;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbpardef_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbpardef_trn`(in p_name varchar(155),in p_desc varchar(50),
      in p_parent varchar(50), in p_search_mod int, in p_tdi_lenght int,in p_user varchar(155),in p_operation int)
BEGIN
	DECLARE l_count int;
	if p_operation = 1 then
		select count(*) into l_count from tbpardef where pd_name = p_name;
        if l_count = 0 then
			INSERT INTO `tbpardef`(`pd_name`,`pd_desc`,`pd_parent`,`pd_tdi_value_lenght`,
				`pd_createby`,`pd_createat`,pd_search_mod)
			VALUES(p_name,p_desc,p_parent,p_tdi_lenght,p_user,now(),p_search_mod);
        end if;
    end if;
    
	if p_operation = 2 then
		UPDATE `tbpardef` SET `pd_desc` = p_desc, `pd_parent` = pd_parent,pd_search_mod=p_search_mod,
		`pd_tdi_value_lenght` = p_tdi_lenght,`pd_updateby` = p_user,`pd_updateat` = now()
		WHERE `pd_name` = p_name; 
    end if;
    
    if p_operation = 3 then
		DELETE FROM `tbdefitems` WHERE `tdi_td_name` = p_name;
		DELETE FROM `tbpardef` WHERE `pd_name` = p_name;  
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbrole_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbrole_trn`(in p_rolename varchar(4000),in p_description varchar(4000),
      in p_access int, in p_operation int,in p_user_id int,in p_role_id int)
BEGIN
      DECLARE l_tbrole_id bigint;
   
    if p_operation = 1 then            
        
       
        
            insert into tbrole( rol_name,rol_description,rol_access) values (p_rolename,
            p_description, p_access);  
            
        
        
        
         
    end if;

    if p_operation = 2 then
       update tbrole set rol_name = p_rolename,rol_description = p_description,rol_access = p_access
       where rol_id = p_role_id;   
    end if;

    if p_operation = 3 then
        delete from tbrole where rol_id = p_role_id;
    end if;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbsearchdetail__trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbsearchdetail__trn`(in p_search_id int, in p_sd_key varchar(20),
in p_sd_keytype int(11), 
in p_sd_keymaintable varchar(155),
in p_sd_keymainfield varchar(155), 
in p_sd_definitionsource varchar(4000),
in p_sd_definitionkeyid varchar(155), 
in p_sd_definitionkeyname varchar(155), 
in p_sd_definitionfilterkey varchar(155), 
in p_sd_definitionfieldid varchar(155),
in p_sd_custom int(11),
in p_sd_custominclude int(11),in p_operation int, in p_sd_id int,in p_labelname varchar(155))
BEGIN
    
	if p_operation = 1 then 
		insert into tbsearchdetail(sd_se_id, sd_key, sd_keytype,sd_keymaintable,sd_keymainfield,sd_definitionsource,
        sd_definitionkeyid,sd_definitionkeyname,sd_definitionfilterkey,sd_definitionfieldid,sd_custom,
        sd_custominclude,sd_label) values(p_search_id, p_sd_key, p_sd_keytype, p_sd_keymaintable, p_sd_keymainfield,
        p_sd_definitionsource, p_sd_definitionkeyid, p_sd_definitionkeyname, p_sd_definitionfilterkey,
        p_sd_definitionfieldid, p_sd_custom, p_sd_custominclude,p_labelname);
    end if;
    
    if p_operation = 2 then
		update tbsearchdetail set sd_se_id = p_search_id, sd_key = p_sd_key, sd_keytype = p_sd_keytype,
        sd_keymaintable = p_sd_keymaintable,sd_keymainfield = p_sd_keymainfield,sd_definitionsource = p_sd_definitionsource,
        sd_definitionkeyid = p_sd_definitionkeyid,sd_definitionkeyname = p_sd_definitionkeyname,
        sd_definitionfilterkey = p_sd_definitionfilterkey ,sd_definitionfieldid = p_sd_definitionfieldid,
        sd_custom = p_sd_custom,
        sd_custominclude = p_sd_custominclude, sd_label = p_labelname
        where sd_id = p_sd_id;
    end if;
    
    if p_operation = 3 then
		delete from tbsearchdetail where sd_id = p_sd_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbsearch_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbsearch_trn`(in p_name varchar(100),in p_mainquery varchar(255),
      in p_description varchar(100),in p_operation int, in p_search_id int,in p_mod_id int)
BEGIN
	if p_operation = 1 then 
		insert into tbsearch(se_name, se_mainquery, se_desc,se_mod_id) values(p_name,p_mainquery,p_description,p_mod_id);
    end if;
    
    if p_operation = 2 then
		update tbsearch set se_name = p_name, se_mainquery = p_mainquery, se_desc = p_description , se_mod_id = p_mod_id
        where se_id = p_search_id;
    end if;
    
    if p_operation = 3 then
		delete from tbsearch where se_id = p_search_id;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tbuser_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tbuser_trn`(in p_username varchar(155),in p_address varchar(4000),
      in p_pass varchar(155),in p_nokp varchar(155),in p_maseh_id int,in p_position varchar(155),in p_position2 varchar(4000)
      ,in p_nophone varchar(4000),in p_isreserved int,  in p_islock int, in p_user varchar(200), 
      in p_operation int, in p_user_id int, in p_mail_id varchar(155), in p_usr_firstname varchar(155), in p_usr_lastname varchar(155))
begin
      declare tbuser_id double;
      declare err_msg varchar(100);
      declare l_reserved int;

    if p_operation = 1 then         
		insert into tbuser( usr_name,usr_address,usr_pass,usr_nokp,usr_role_id,usr_position,usr_position2,usr_nophone,
		usr_isreserved, usr_islock,usr_updatedate,usr_updateuser,usr_email,usr_firstname,usr_lastname) 
		values (p_username,
		p_address, p_pass, p_nokp, p_maseh_id, p_position, p_position2, p_nophone, 
		p_isreserved, p_islock, sysdate(), p_user,p_mail_id,p_usr_firstname,p_usr_lastname);
		
    end if;

    if p_operation = 2 then
		select usr_isreserved into l_reserved from tbuser where usr_id = p_user_id;
		if l_reserved <> 1 then
       update tbuser set usr_address = p_address,usr_nokp = p_nokp
       ,usr_role_id = p_maseh_id,usr_position = p_position,usr_position2 = p_position2 ,usr_nophone = p_nophone,
            usr_isreserved = p_isreserved, usr_islock = p_islock,
            usr_firstname = p_usr_firstname ,usr_lastname = p_usr_lastname where usr_name = p_username;   
		end if;
    end if;
    

    if p_operation = 3 then
		select usr_isreserved into l_reserved from tbuser where usr_id = p_user_id;
		if l_reserved <> 1 then
        delete from tbuser where usr_id = p_user_id   ;
        end if;
    end if;


	if p_operation = 4 then
        update tbuser set usr_pass = p_pass where usr_name = p_username;
        update users set password = p_pass where email = p_username;
    end if;

  end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_toneallowance_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_toneallowance_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_allowancetype varchar(5);
DECLARE l_bldgcategory varchar(3);
DECLARE l_factor varchar(3);
DECLARE l_value float;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.allowancetype'))) INTO l_allowancetype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.bldgcate'))) INTO l_bldgcategory;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.factor'))) INTO l_factor;
	 SELECT replace(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.value'))), ',','') INTO l_value;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 if l_operation <> 3 then
		SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))),0) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.allowanceid'))) INTO l_id;

	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_tone_bldg_allowances`(`tallo_tone_id`,    `tallo_allowancetype_id`,    `tallo_buldingcategory_id`,
    `tallo_value`,    `tallo_factor`,    `tallo_createby`,    `tallo_createdate`,    `tallo_updateby`,
    `tallo_updatedate`)
			VALUES(l_toneid, l_allowancetype, l_bldgcategory, l_value, l_factor,  p_username, now(), p_username, now());
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_tone_bldg_allowances SET `tallo_tone_id` = l_toneid,    `tallo_allowancetype_id` = l_allowancetype,   
        `tallo_buldingcategory_id` = l_bldgcategory,    `tallo_value` = l_value,
    `tallo_factor` = l_factor,
    `tallo_updateby` = p_username,    `tallo_updatedate` = now()
		WHERE `tallo_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_bldg_allowances WHERE tallo_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonebasket_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonebasket_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_year varchar(4);
DECLARE l_eyear varchar(4);
DECLARE l_desc varchar(200);
DECLARE l_status varchar(1);
DECLARE l_operation int;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.year'))) INTO l_year;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.eyear'))) INTO l_eyear;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.desc'))) INTO l_desc;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.status'))) INTO l_status;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))) INTO l_id;

	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_toneoflistbasket`(`tollis_year`,    `tollis_enforceyear`,    `tollis_desc`,    
            `tollis_activeind_id`,    `tollis_createby`,    `tollis_createdate`,
    `tollis_updateby`,    `tollis_updatedate`)
			VALUES(l_year, l_eyear, l_desc, l_status, p_username, now(), p_username, now());
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_toneoflistbasket SET `tollis_year` = l_year,`tollis_enforceyear` = l_eyear,
		`tollis_desc` = l_desc,`tollis_activeind_id` = l_status,
		`tollis_updateby` = p_username, `tollis_updatedate` = now()
		WHERE `tollist_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_bldg_allowances WHERE tallo_tone_id = l_id;
		DELETE FROM cm_tone_bldg_depreciation WHERE tdepre_tone_id = l_id;
		DELETE FROM cm_tone_building WHERE tbldg_tone_id = l_id;
		DELETE FROM cm_tone_land WHERE tland_tone_id = l_id;
		DELETE FROM cm_tone_land_standart WHERE tstand_tone_id = l_id;
		DELETE FROM cm_toneoflistbasket WHERE tollist_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonebldgt_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonebldgt_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_subzon varchar(4);
DECLARE l_proptype varchar(3);
DECLARE l_propstorey varchar(3);
DECLARE l_areatype varchar(2);
DECLARE l_arealevel varchar(3);
DECLARE l_areacategory varchar(2);
DECLARE l_areause varchar(3);
DECLARE l_value float;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.subzon'))) INTO l_subzon;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.proptype'))) INTO l_proptype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.propstorey'))) INTO l_propstorey;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.areatype'))) INTO l_areatype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.arealevel'))) INTO l_arealevel;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.areacategory'))) INTO l_areacategory;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.areause'))) INTO l_areause;
	 SELECT replace(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.value'))), ',','') INTO l_value;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 if l_operation <> 3 then
		SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))),0) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.bldgid'))) INTO l_id;
 if (l_subzon is not null and l_subzon <> '') and (l_proptype is not null and l_proptype <> '')  and (l_propstorey is not null and l_propstorey <> '') then
	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_tone_building`(`tbldg_tone_id`,    `tbldg_subzon_id`,    `tbldg_proptype_id`,    
            `tbldg_propstorey_id`,    `tbldg_areatype_id`,    `tbldg_arealevel_id`,
    `tbldg_areacategory_id`,    `tbldg_areause_id`,  `tbldg_value`,    `tbldg_createby`,    
            `tbldg_createdate`,    `tbldg_udpateby`,    `tbldg_updatedate`)
			VALUES(l_toneid, l_subzon, l_proptype, l_propstorey, l_areatype, l_arealevel, l_areacategory,
            l_areause, l_value, p_username, now(), p_username, now());
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_tone_building SET `tbldg_tone_id` = l_toneid,    `tbldg_subzon_id` = l_subzon,    `tbldg_proptype_id` = l_proptype,    
            `tbldg_propstorey_id` = l_propstorey,    `tbldg_areatype_id` = l_areatype,    `tbldg_arealevel_id` = l_arealevel,
    `tbldg_areacategory_id` = l_areacategory,    `tbldg_areause_id` = l_areause,  `tbldg_value` = l_value,
		`tbldg_udpateby` = p_username, `tbldg_updatedate` = now()
		WHERE `tbldg_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_building WHERE tbldg_id = l_id;
    end if;
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonebldg_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonebldg_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_subzon varchar(5);
DECLARE l_proptype varchar(3);
DECLARE l_propstorey varchar(3);
DECLARE l_areatype varchar(2);
DECLARE l_arealevel varchar(3);
DECLARE l_areacategory varchar(2);
DECLARE l_trnstype varchar(2);
DECLARE l_areause varchar(3);
DECLARE l_value float;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.subzone'))) INTO l_subzon;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.proptype'))) INTO l_proptype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.propstoery'))) INTO l_propstorey;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.artype'))) INTO l_areatype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.arlvl'))) INTO l_arealevel;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.arcate'))) INTO l_areacategory;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.aruse'))) INTO l_areause;
	 SELECT replace(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.value'))), ',','') INTO l_value;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.trnstype'))) INTO l_trnstype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 if l_operation <> 3 then
		SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))),0) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.bldgid'))) INTO l_id;
   --  if (l_subzon is not null and l_subzon <> '') and (l_proptype is not null and l_proptype <> '')  and (l_propstorey is not null and l_propstorey <> '') then
    
		select count(*) into l_count from cm_tone_building where `tbldg_tone_id` = l_toneid and    `tbldg_subzon_id` = l_subzon and  `tbldg_proptype_id` = l_proptype and    
				`tbldg_propstorey_id` = l_propstorey and    `tbldg_areatype_id` = l_areatype and  `tbldg_arealevel_id` = l_arealevel and
		`tbldg_areacategory_id` = l_areacategory and  `tbldg_areause_id` = l_areause;
		if l_operation = 1 then   
			
			if l_count = 0 then
				INSERT INTO `cm_tone_building`(`tbldg_tone_id`,    `tbldg_subzon_id`,    `tbldg_proptype_id`,    
				`tbldg_propstorey_id`,    `tbldg_areatype_id`,    `tbldg_arealevel_id`,
		`tbldg_areacategory_id`,    `tbldg_areause_id`,  `tbldg_value`,    `tbldg_createby`,    
				`tbldg_createdate`,    `tbldg_udpateby`,    `tbldg_updatedate`,`tbldg_transtype_id`,`tbldg_approvalbldgstatus_id`)
				VALUES(l_toneid, l_subzon, l_proptype, l_propstorey, l_areatype, l_arealevel, l_areacategory,
				l_areause, l_value, p_username, now(), p_username, now(), l_trnstype,1);
			 end if;
		end if;
		
		if l_operation = 2 then            
			UPDATE cm_tone_building SET `tbldg_tone_id` = l_toneid,    `tbldg_subzon_id` = l_subzon,    `tbldg_proptype_id` = l_proptype,    
				`tbldg_propstorey_id` = l_propstorey,    `tbldg_areatype_id` = l_areatype,    `tbldg_arealevel_id` = l_arealevel,
		`tbldg_areacategory_id` = l_areacategory,    `tbldg_areause_id` = l_areause,  `tbldg_value` = l_value,
			`tbldg_udpateby` = p_username, `tbldg_updatedate` = now(), `tbldg_transtype_id` = l_trnstype
			WHERE `tbldg_id` = l_id;
		end if;
		
		if l_operation = 3 then  
			DELETE FROM cm_tone_building WHERE tbldg_id = l_id;
		end if;
   --  end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonedepreciation_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonedepreciation_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_bldgcondition varchar(5);
DECLARE l_value float;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.bldgcond'))) INTO l_bldgcondition;
	 SELECT replace(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.value'))), ',','') INTO l_value;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
     if l_operation <> 3 then
		SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))),0) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.depreciationid'))) INTO l_id;
select count(*) into l_count from cm_tone_bldg_depreciation where `tdepre_tone_id` = l_toneid and    `tdepre_bldgcondn_id` = l_bldgcondition;
	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_tone_bldg_depreciation`(`tdepre_tone_id`,    `tdepre_bldgcondn_id`,    `tdepre_value`,
    `tdepre_createby`,    `tdepre_createdate`,    `tdepre_updateby`,    `tdepre_updatedate`,`tdepre_approvaltdeprestatus_id`)
			VALUES(l_toneid, l_bldgcondition, l_value,  p_username, now(), p_username, now(),'1');
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_tone_bldg_depreciation SET `tdepre_tone_id` = l_toneid,    `tdepre_bldgcondn_id` = l_bldgcondition,   
        `tdepre_value` = l_value,
    `tdepre_updateby` = p_username,    `tdepre_updatedate` = now()
		WHERE `tdepre_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_bldg_depreciation WHERE tdepre_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonelandstandart_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonelandstandart_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_proptype varchar(3);
DECLARE l_propstorey varchar(3);
DECLARE l_subzon varchar(5);
DECLARE l_nextarea int;
DECLARE l_standardarea int;
DECLARE l_maxlevel int;
DECLARE l_value float;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.subzone'))) INTO l_subzon;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.proptype'))) INTO l_proptype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.propstoery'))) INTO l_propstorey;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.standardarea'))) INTO l_standardarea;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.nextarea'))) INTO l_nextarea;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.maxarea'))) INTO l_maxlevel;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
     
     if l_operation <> 3 then
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.landid'))) INTO l_id;
select count(*) into l_count from cm_tone_land_standart where `tstand_tone_id` = l_toneid and    `tstand_subzon_id` = l_subzon and   
        `tstand_proptype_id` = l_proptype and    `tstand_propstorey_id` = l_propstorey;
	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_tone_land_standart`(`tstand_tone_id`,    `tstand_subzon_id`,    
            `tstand_proptype_id`,    `tstand_propstorey_id`,
    `tstand_standartarea`,    `tstand_nextarea`,  `tstand_maxlevel`,  `tstand_createby`,    `tstand_createdate`,    `tstand_updateby`,
    `tstand_updatedate`,`tstand_approvaltstandstatus_id`)
			VALUES(l_toneid, l_subzon, l_proptype, l_propstorey, l_standardarea, l_nextarea,l_maxlevel, p_username, now(),
            p_username, now(),'1');
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_tone_land_standart SET `tstand_tone_id` = l_toneid,    `tstand_subzon_id` = l_subzon,   
        `tstand_proptype_id` = l_proptype,    `tstand_propstorey_id` = l_propstorey,
    `tstand_standartarea` = l_standardarea,    `tstand_nextarea` = l_nextarea,    `tstand_maxlevel` = l_maxlevel,   
    `tstand_updateby` = p_username,    `tstand_updatedate` = now()
		WHERE `tstand_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_land_standart WHERE tstand_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_toneland_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_toneland_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_hasbldg varchar(5);
DECLARE l_proptype varchar(3);
DECLARE l_propstorey varchar(3);
DECLARE l_subzon varchar(5);
DECLARE l_value float;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.subzone'))) INTO l_subzon;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.proptype'))) INTO l_proptype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.propstoery'))) INTO l_propstorey;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.hasbldg'))) INTO l_hasbldg;
	 SELECT replace(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.value'))), ',','') INTO l_value;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 if l_operation <> 3 then
		SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))),0) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.landid'))) INTO l_id;
select count(*) into l_count from cm_tone_land where `tland_tone_id` = l_toneid and    `tland_ishasbuilding_id` = l_hasbldg and   
        `tland_subzon_id` = l_subzon and    `tland_proptype_id` = l_proptype and
    `tland_propstorey_id` = l_propstorey;
	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_tone_land`(`tland_tone_id`,    `tland_ishasbuilding_id`,    `tland_subzon_id`,    `tland_proptype_id`,
    `tland_propstorey_id`,    `tland_value`,    `tland_createby`,    `tland_createdate`,    `tland_updateby`,
    `tland_updatedate`,`tland_approvaltlandstatus_id`)
			VALUES(l_toneid, l_hasbldg, l_subzon, l_proptype, l_propstorey, l_value, p_username, now(), p_username, now(),1);
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_tone_land SET `tland_tone_id` = l_toneid,    `tland_ishasbuilding_id` = l_hasbldg,   
        `tland_subzon_id` = l_subzon,    `tland_proptype_id` = l_proptype,
    `tland_propstorey_id` = l_propstorey,    `tland_value` = l_value,   
    `tland_updateby` = p_username,    `tland_updatedate` = now()
		WHERE `tland_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_land WHERE tland_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonetaxbasket_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonetaxbasket_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_year varchar(4);
DECLARE l_eyear varchar(4);
DECLARE l_desc varchar(200);
DECLARE l_status varchar(1);
DECLARE l_operation int;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.year'))) INTO l_year;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.eyear'))) INTO l_eyear;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.desc'))) INTO l_desc;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.status'))) INTO l_status;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))) INTO l_id;

	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_taxratelistbasket`(`trlist_year`,    `trlist_enforceyear`,    `trlist_desc`,    
            `trlist_activeind_id`,    `trlist_createby`,    `trlist_createdate`,
    `trlist_updateby`,    `trlist_updatedate`)
			VALUES(l_year, l_eyear, l_desc, l_status, p_username, now(), p_username, now());
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_taxratelistbasket SET `trlist_year` = l_year,`trlist_enforceyear` = l_eyear,
		`trlist_desc` = l_desc,`trlist_activeind_id` = l_status,
		`trlist_updateby` = p_username, `trlist_updatedate` = now()
		WHERE `trlist_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_taxrate WHERE trate_trlist_id = l_id;
		DELETE FROM cm_taxratelistbasket WHERE trlist_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_tonetaxrate_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tonetaxrate_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_toneid int;
DECLARE l_operation int;
DECLARE l_proptype varchar(3);
DECLARE l_hasbldg varchar(3);
DECLARE l_zone varchar(5);
DECLARE l_value float;
DECLARE l_count int default 0;

	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.zone'))) INTO l_zone;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.proptype'))) INTO l_proptype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.hasbldg'))) INTO l_hasbldg;
	 SELECT replace(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.value'))), ',','') INTO l_value;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 if l_operation <> 3 then
		SELECT ifnull(TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.basketid'))),0) INTO l_toneid;
     end if;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.taxid'))) INTO l_id;
select count(*) into l_count from cm_tone_taxrate where `trate_trlist_id` = l_toneid and    `trate_zon_id` = l_zone and   
        `trate_ishasbuilding_id` = l_hasbldg and    `trate_proptype_id` = l_proptype;
	if l_operation = 1 then   
        if l_count = 0 then
			INSERT INTO `cm_tone_taxrate`(`trate_trlist_id`,    `trate_zon_id`,    
            `trate_ishasbuilding_id`,    `trate_proptype_id`, `trate_value`,    `trate_createby`,  `trate_createdate`,
            `trate_updateby`,    `trate_updatedate`,`trate_approvaltratestatus_id`)
			VALUES(l_toneid, l_zone, l_hasbldg, l_proptype, l_value, p_username, now(), p_username, now(),'1');
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_tone_taxrate SET `trate_trlist_id` = l_toneid,    `trate_zon_id` = l_zone,   
        `trate_ishasbuilding_id` = l_hasbldg,    `trate_proptype_id` = l_proptype,
    `trate_value` = l_value,  `trate_updateby` = p_username,    `trate_updatedate` = now()
		WHERE `trate_id` = l_id;
    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_tone_taxrate WHERE trate_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_transaction_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_transaction_trn`(in p_param TEXT, in p_username varchar(100))
BEGIN
DECLARE l_id int;
DECLARE l_transtype varchar(1);
DECLARE l_linkid varchar(212);
DECLARE l_lotcode varchar(2);
DECLARE l_lotno varchar(20);
DECLARE l_titletype varchar(2);
DECLARE l_titltno varchar(20); 
DECLARE l_transdate date;
DECLARE l_price float;
DECLARE l_duration int;
DECLARE l_address1 varchar(100);
DECLARE l_address2 varchar(100);
DECLARE l_address3 varchar(100);
DECLARE l_address4 varchar(100);
DECLARE l_postcode varchar(6);
DECLARE l_state varchar(2);
DECLARE l_city varchar(50);
DECLARE l_operation int;
DECLARE l_count int default 0;

 
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.transtype'))) INTO l_transtype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.linkid'))) INTO l_linkid;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.lotcode'))) INTO l_lotcode;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.lotno'))) INTO l_lotno;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.titletype'))) INTO l_titletype;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.titltno'))) INTO l_titltno;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.transdate'))) INTO l_transdate;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.price'))) INTO l_price;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.duration'))) INTO l_duration;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address1'))) INTO l_address1;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address2'))) INTO l_address2;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address3'))) INTO l_address3;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.address4'))) INTO l_address4;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.postcode'))) INTO l_postcode;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.state'))) INTO l_state;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.city'))) INTO l_city;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.operation'))) INTO l_operation;
	 SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,'$.transactionid'))) INTO l_id;

	if l_operation = 1 then   
		
        if l_count = 0 then
			INSERT INTO `cm_transaction`(`trans_transtype_id`,    `trans_linkid`,    `trans_lotcode_id`,    `trans_lotno`,    `trans_titletype_id`,    `trans_titleno`,
    `trans_transdate`,    `trans_price`,    `trans_duration`,      `trans_addr_ln1`,    `trans_addr_ln2`,
    `trans_addr_ln3`,    `trans_addr_ln4`,    `trans_postcode`,    `trans_city`,    `trans_state_id`,    `trans_createby`,
    `trans_createdate`,    `trans_updateby`,    `trans_updatedate`)
			VALUES(l_transtype, l_linkid, l_lotcode, l_lotno, l_titletype, l_titltno, l_transdate, l_price, 
			l_duration, l_address1, l_address2, l_address3, l_address4, l_postcode,l_city, l_state, p_username, now(), p_username, now());
		 end if;
    end if;
    
    if l_operation = 2 then            
		UPDATE cm_transaction SET `trans_transtype_id` = l_transtype,`trans_linkid` = l_linkid,
`trans_lotcode_id` = l_lotcode,`trans_lotno` = l_lotno,`trans_titletype_id` = l_titletype,
`trans_titleno` = l_titltno,`trans_transdate` = l_transdate,`trans_price` = l_price,
`trans_duration` = l_duration,`trans_addr_ln1` = l_address1,
`trans_addr_ln2` = l_address2,`trans_addr_ln3` = l_address3,`trans_addr_ln4` = l_address4,
`trans_postcode` = l_postcode,`trans_city` = l_city,`trans_state_id` =l_state,
`trans_updateby` = p_username,
`trans_updatedate` = now()
WHERE `trans_id` = l_id;

    end if;
    
    if l_operation = 3 then  
		DELETE FROM cm_transaction WHERE trans_id = l_id;
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_valuation_process` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_valuation_process`(p_valuationbasket_id int, p_tonebasket_id int,
  p_tonetaxbasket_id int,  p_username varchar(50),drivedvalue float,drivedrate float,out p_result text)
BEGIN
	DECLARE l_approvestaus varchar(50);
	DECLARE l_valtype varchar(2);
	DECLARE l_count int(11);
	DECLARE l_totalcount int(11);
	DECLARE l_valcount int(11);
 	DECLARE `_rollback` BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;
    START TRANSACTION;
    
	select vt_valbase_id into l_valtype from cm_appln_valterm 
	inner join cm_appln_val on va_vt_id = vt_id  where va_id = p_valuationbasket_id limit 1;
	
    select count(*) into l_count from cm_appln_val inner join cm_appln_valdetl on vd_va_id = va_id  
	where va_id = p_valuationbasket_id and vd_approvalstatus_id = '07';
	
    
    
	select count(*) into l_totalcount from cm_appln_val inner join cm_appln_valdetl on vd_va_id = va_id  
	where va_id = p_valuationbasket_id ;

	

	select va_approvalstatus_id into l_approvestaus from cm_appln_val where va_id = p_valuationbasket_id;
	if l_approvestaus = '05' or l_approvestaus = '06' then
		if l_count > 0 then
			if l_valtype = 1 then
				CALL mass_lot(p_valuationbasket_id, p_tonebasket_id, p_username);
				CALL mass_bldg(p_valuationbasket_id, p_tonebasket_id, p_username);
				CALL mass_tax(p_valuationbasket_id, p_tonetaxbasket_id,drivedrate,drivedvalue, p_username);
			end if;
			if l_valtype = 2 then
				CALL mass_lot2(p_valuationbasket_id, p_tonebasket_id, p_username);
				CALL mass_bldg2(p_valuationbasket_id, p_tonebasket_id, p_username);
				CALL mass_tax2(p_valuationbasket_id, p_tonetaxbasket_id,drivedrate,drivedvalue, p_username);
			end if;
	
		end if;
        
        select count(*) into l_valcount from cm_appln_val inner join cm_appln_valdetl on vd_va_id = va_id  
		where va_id = p_valuationbasket_id and vd_approvalstatus_id in ('08','09','10');
        
		if l_totalcount = l_valcount then 
			update cm_appln_val set va_approvalstatus_id = '07' where va_id = p_valuationbasket_id;
		end if;
        
	else
		 set p_result = 'Basket not ready for valuation ';
	end if;
 IF `_rollback` THEN
    
		ROLLBACK;
		call proc_resetmass(p_valuationbasket_id,'B');
		
		set p_result = 'Mass valuation failed and Data Rollback';
    ELSE
        COMMIT;
        if  l_count > 0 then
			set p_result = 'Mass valuation successfully done';
		else	
			set p_result = 'No Property available for valuation';
        end if;
 END IF;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pro_termattachment_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_termattachment_trn`(id int, p_path varchar(200), p_filename varchar(200),p_orgname varchar(200), p_desc varchar(200),
p_ext varchar(10), p_attachtype varchar(10), p_operation int, p_user varchar(50) )
BEGIN

	if p_operation = 1 then 
		insert into cm_attachment(at_linkid, at_attachtype_id, at_name, at_detail, at_oringinalfilename, at_fileextention,
				at_path,at_createby, at_createdate, at_updateby, at_updatedate)
				values(id, p_attachtype, p_filename, p_desc, p_orgname, p_ext, p_path,
                p_user, now(), p_user, now());
    
    end if;
	
    if p_operation = 2 then 
		delete from cm_attachment where at_id = id;    
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `test` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `test`(`p_param` JSON
,
	`p_user` VARCHAR(50),
    p_type varchar(50),
    p_accountnumber varchar(15)
)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE res varchar(4000);
DECLARE bldgnum varchar(100);
DECLARE bldg_id int;
DECLARE reffinfo varchar(50);
DECLARE artype varchar(55);
DECLARE arlevel varchar(55);
DECLARE arcate varchar(50);
DECLARE arzone varchar(50);
DECLARE aruse varchar(50);
DECLARE ardesc varchar(50);
DECLARE dimention varchar(50);
DECLARE arcnt int;
DECLARE size float;
DECLARE uom varchar(50);
DECLARE totsize float;
DECLARE fltype varchar(50);
DECLARE walltype varchar(50);
DECLARE celingtype varchar(50);
DECLARE artype_id varchar(5);
DECLARE arlevel_id varchar(5);
DECLARE arcate_id varchar(5);
DECLARE arzone_id varchar(5);
DECLARE bldgtypeid varchar(55);
DECLARE bldgcategoryid varchar(55);
DECLARE aruse_id varchar(5);
DECLARE fltype_id varchar(5);
DECLARE walltype_id varchar(5);
DECLARE celingtype_id varchar(5);
DECLARE bldgaccnum varchar(15);
DECLARE size_id varchar(5);
DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgar_id int;
DECLARE operation int;
DECLARE actioncode varchar(10);
DECLARE outtext varchar(255);

WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgnum')))) INTO bldgnum;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgaccnum')))) INTO bldgaccnum;

    if bldgnum <> '' then
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].reffinfo')))) INTO reffinfo;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].artype')))) INTO artype;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arlevel')))) INTO arlevel;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcate')))) INTO arcate;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arzone')))) INTO arzone;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].aruse')))) INTO aruse;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].ardesc')))) INTO ardesc;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].dimention')))) INTO dimention;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arcnt')))) INTO arcnt;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].uom')))) INTO uom; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].totsize')))) INTO totsize; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].fltype')))) INTO fltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].walltype')))) INTO walltype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].celingtype')))) INTO celingtype; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].size')))) INTO size; 
    
       
    select bl_id, bl_bldgtype_id into bldg_id, bldgtypeid from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = bldgaccnum);	
        SELECT arlevel;
        
    select tdi_parent_key into bldgcategoryid from tbdefitems where tdi_td_name = 'BULDINGTYPE' and tdi_value = bldgtypeid limit 1; 
    
    if artype <> '' then
    select tdi_key into artype_id from tbdefitems where tdi_td_name = 'AREATYPE' and tdi_value = artype limit 1;    
	 end if; 
	 if arlevel <> '' then
    select tdi_key into arlevel_id from tbdefitems where tdi_td_name = 'AREALEVEL' and tdi_value = arlevel  and tdi_parent_key = bldgcategoryid limit 1;  
	 end if; 
	 if arcate <> '' then    
    select tdi_key into arcate_id from tbdefitems where tdi_td_name = 'AREACATEGORY' and tdi_value = arcate limit 1;      
	 end if; 
	 if arzone <> '' then
    select tdi_key into arzone_id from tbdefitems where tdi_td_name = 'AREAZONE' and tdi_value = arzone limit 1;   
	 end if; 
	 if aruse <> '' then   
    select tdi_key into aruse_id from tbdefitems where tdi_td_name = 'AREAUSE' and tdi_value = aruse  and tdi_parent_key = bldgcategoryid limit 1;   
	 end if; 
   
	 if fltype <> '' then       
    select tdi_key into fltype_id from tbdefitems where tdi_td_name = 'FLOORTYPE' and tdi_value = fltype limit 1;     
	 end if; 
	 if walltype <> '' then 
    select tdi_key into walltype_id from tbdefitems where tdi_td_name = 'WALLTYPE' and tdi_value = walltype limit 1;    
	 end if; 
	 if celingtype <> '' then  
    select tdi_key into celingtype_id from tbdefitems where tdi_td_name = 'CEILINGTYPE' and tdi_value = celingtype limit 1;  
	 end if; 
     
     
	 if uom <> '' then  
    select tdi_key into size_id from tbdefitems where tdi_td_name = 'SIZEUNIT' and tdi_value = uom;
	 end if; 


if p_type = 'tab' then
	 select bl_id into bldg_id from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = p_accountnumber);	
   select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
and ba_areacategory_id = arcate_id;
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO l_bldgar_id; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
    if actioncode = 'new' then 
	    
        if l_count = 0 then
			INSERT INTO `cm_bldgarea`
			(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
			`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
			`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
			VALUES (ifnull(bldg_id,bldgnum), reffinfo, artype,  arlevel, arcate, arzone, aruse, ardesc, dimention, arcnt, 
			uom, totsize, fltype,
			walltype, celingtype, p_user, now(), p_user, now(),size);
		
		end if;
    end if;
    
    if actioncode = 'update' then 
		
        
			update`cm_bldgarea` set
			`BA_REF` = reffinfo,
            `BA_AREATYPE_ID` = artype,`BA_AREALEVEL_ID` =arlevel,
            `BA_AREACATEGORY_ID` = arcate,`BA_AREAZONE_ID` =arzone,`BA_AERAUSE_ID` = aruse ,
			`BA_AREADESC` = ardesc,`BA_DIMENTION` = dimention,`BA_UNITCOUNT` = arcnt,`BA_SIZEUNIT_ID` = uom
            ,`BA_TOTSIZE` = totsize,`BA_FLOORTYPE_ID` = fltype,`BA_WALLTYPE_ID` = walltype,
            BA_SIZE = size,
			`BA_CEILINGTYPE_ID` = celingtype,`BA_UPDATEBY` = p_user,`BA_UPDATEDATE` = now() where
            BA_ID = l_bldgar_id;
		
    
    end if;
    
    if actioncode = 'delete' then 
		delete from cm_bldgarea where BA_ID = l_bldgar_id;
    end if;
    
else
select count(*) into l_count from cm_bldgarea where ba_bl_id = bldg_id and ba_areatype_id = artype_id and ba_arealevel_id = arlevel_id
and ba_areacategory_id = arcate_id and BA_REF = reffinfo and BA_AREAZONE_ID = arzone_id and BA_AERAUSE_ID = aruse_id 
and BA_AREADESC = ardesc and BA_DIMENTION = dimention  and BA_UNITCOUNT = arcnt  and BA_SIZEUNIT_ID = size_id 
 and BA_TOTSIZE = totsize  and BA_FLOORTYPE_ID = fltype_id 
 and BA_WALLTYPE_ID = walltype_id  and BA_CEILINGTYPE_ID = celingtype_id ;
if l_count = 0 then
		INSERT INTO `cm_bldgarea`
		(`BA_BL_ID`,`BA_REF`,`BA_AREATYPE_ID`,`BA_AREALEVEL_ID`,`BA_AREACATEGORY_ID`,`BA_AREAZONE_ID`,`BA_AERAUSE_ID`,
		`BA_AREADESC`,`BA_DIMENTION`,`BA_UNITCOUNT`,`BA_SIZEUNIT_ID`,`BA_TOTSIZE`,`BA_FLOORTYPE_ID`,`BA_WALLTYPE_ID`,
		`BA_CEILINGTYPE_ID`,`BA_CREATEBY`,`BA_CREATEDATE`,`BA_UPDATEBY`,`BA_UPDATEDATE`,BA_SIZE)
		VALUES (bldg_id, reffinfo, artype_id,  arlevel_id, arcate_id, arzone_id, aruse_id, ardesc, dimention, arcnt, 
		size_id, totsize, fltype_id,
		walltype_id, celingtype_id, p_user, now(), p_user, now(),size);
end if;
end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 11:38:47
