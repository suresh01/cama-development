DROP PROCEDURE `proc_cmlot_trn`;

DELIMITER $$
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
DECLARE l_stratano varchar(50);
DECLARE tenanttype_id varchar(5);
DECLARE landuse_id varchar(5);
DECLARE l_count int default 0;
DECLARE l_lotid int default 0;
DECLARE operation int default 0;
 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lotype')))) INTO lotype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lotnum')))) INTO lotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.altlotnum')))) INTO altlotnum;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lttt')))) INTO lottitletype;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.ltnum')))) INTO lottitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.altnum')))) INTO alttitlenum; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tentype')))) INTO tenuretype; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tenduration')))) INTO tenureperiod; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tenstart')))) INTO st_tenstartdt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.tenend')))) INTO st_tenenddt; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.stratano')))) INTO l_stratano; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.al_id')))) INTO l_id; 
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.lot_id')))) INTO l_lotid; 
	  
	-- if p_type = 'update' then
		 
			UPDATE cm_lot_log SET `log_lotcode_id` = lotype, `log_no` = lotnum
			, `log_altno` = altlotnum, `log_alttitleno` = alttitlenum, `log_tenuretype_id` = tenuretype
			, `log_tenureperiod` = tenureperiod,  `log_startdate` =  DATE_FORMAT(STR_TO_DATE(st_tenstartdt, '%d/%m/%Y'), '%Y-%m-%d'),
			`log_expireddate` =  DATE_FORMAT(STR_TO_DATE(st_tenenddt, '%d/%m/%Y'), '%Y-%m-%d')
			,`log_titletype_id` = lottitletype, log_approvalstatus_id = 5, log_stratano = l_stratano
			 WHERE log_id = l_id;
             
             select l_stratano;
             UPDATE cm_lot SET `lo_lotcode_id` = lotype, `lo_no` = lotnum
			, `lo_altno` = altlotnum, LO_TITLETYPE_ID = lottitletype, LO_TITLENO =lottitlenum, `lo_alttitleno` = alttitlenum, `lo_tenuretype_id` = tenuretype
			, `lo_tenureperiod` = tenureperiod,  `lo_startdate` =  DATE_FORMAT(STR_TO_DATE(st_tenstartdt, '%d/%m/%Y'), '%Y-%m-%d'),
			`lo_expireddate` =  DATE_FORMAT(STR_TO_DATE(st_tenenddt, '%d/%m/%Y'), '%Y-%m-%d')
			, lo_stratano = l_stratano
			 WHERE lot_id = l_lotid;
		-- end if;
END$$
DELIMITER ;
