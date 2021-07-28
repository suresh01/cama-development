
DROP PROCEDURE `cama`.`proc_property_register_table`;

DROP FUNCTION `cama`.`pr_bldg_area_register`;
DROP FUNCTION `cama`.`pr_owner_register`;
DROP FUNCTION `cama`.`pr_bldg_register`;
DROP FUNCTION `cama`.`pr_lot_register`;
DROP FUNCTION `cama`.`pr_master_add`;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_property_register_table`(
	IN `master_param` json,
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
    set @result = pr_lot_register(master_param, p_user,'',@msg);
    set @result = pr_owner_register(master_param, p_user,'',@msg);
    set @result = pr_bldg_register(master_param, p_user,'',@msg);
    set @result = pr_bldg_area_register(master_param, p_user,'',@msg);
    
    
END$$
DELIMITER ;


DELIMITER $$
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
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')))) INTO bldgaccnum;
    
    
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
    select  bl_bldgtype_id, bl_id into  bldgtypeid, bldg_id from cm_bldg where bl_bldg_no = bldgnum and bl_ma_id = (select ma_id from cm_masterlist where ma_accno = bldgaccnum);	
       
        
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
END$$
DELIMITER ;

DELIMITER $$
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
DECLARE city varchar(55);
DECLARE emailid varchar(150);
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
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')))) INTO owneraccnum;
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
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].owncity')))) INTO city; 
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].emailno')))) INTO emailid;
     
    
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
		`TO_CREATEBY`,`TO_CREATEDATE`,`TO_UPDATEBY`,`TO_UPDATEDATE`,TO_TELNO,TO_FAXNO, TO_NUMETR,TO_CITY,TO_EMAIL)
		values(l_master_id,ownaplntype,typeofown,ownnum, ownname ,ownaddr1, ownaddr2, ownaddr3,ownaddr4,ownpostcode ,ownstate,
		citizen, race, demominator, p_user, now(), p_user, now(),telno,faxno, numerator,city,emailid);
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
END$$
DELIMITER ;

DELIMITER $$
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
DECLARE mainbldg_id varchar(5);

DECLARE l_count int;
DECLARE l_master_id int;
DECLARE l_bldgid int default 0;
DECLARE operation int;
DECLARE actioncode varchar(10);
WHILE i < JSON_LENGTH(p_param) DO
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')))) INTO bldgaccnum;
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
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].mbldg')))) INTO mainbldg; 
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
     if mainbldg <> '' then  
    select tdi_key into mainbldg_id from tbdefitems where tdi_td_name = 'ISMAINBLDG' and tdi_value = mainbldg limit 1 ;    
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
walltype_id,floortype_id,cccdt, occupieddt,mainbldg_id, p_user, now(), p_user, now());
end if;
    end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;
RETURN 1;
END$$
DELIMITER ;

DELIMITER $$
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
DECLARE alttitlenum varchar(55);
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
DECLARE stratano varchar(100);


WHILE i < JSON_LENGTH(p_param) DO
	
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')))) INTO acc_no;
    -- if  acc_no = null then
		-- SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].accnumber')))) INTO acc_no;
    -- end if;
    
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
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lostratano')))) INTO stratano; 
		
    
    
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
					`LO_CREATEDATE`,`LO_UPDATEBY`,`LO_UPDATEDATE`, `LO_STRATANO`)
					VALUES(l_master_id, state, district, lotype, lotnum, altlotnum, lottitletype, lottitlenum,
					 alttitlenum, landar, landarunit, lancond, lanposition, roadtype, roadcategory, landuse, expresscond,
					 interest, tenuretype, tenureperiod, st_tenstartdt, st_tenenddt, landstatus,p_user,now(),p_user, now(), stratano);
				end if;
            end if; 
            if actioncode = 'update' then
				UPDATE  `cm_lot` SET
					`LO_STATE` = state,`LO_DISTRICT` = district,`LO_LOTCODE_ID` = 
                    lotype,`LO_NO` = lotnum,
					`LO_ALTNO` = altlotnum,`LO_TITLETYPE_ID` = lottitletype,`LO_TITLENO` = lottitlenum,
                    `LO_ALTTITLENO` = alttitlenum,`LO_SIZE` = landar,`LO_SIZEUNIT_ID` = landarunit,`LO_LANDCONDITION_ID` = lancond,
					`LO_LANDPOSITION_ID` = lanposition,`LO_ROADTYPE_ID` = roadtype,`LO_ROADCATEGORY_ID` = roadcategory,
                    `LO_LANDUSE_ID` = landuse,`LO_EXCD` = expresscond,`LO_RTIT` = interest,  `LO_STRATANO` =stratano,
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
				`LO_TENURETYPE_ID`,`LO_STARTDATE`,`LO_EXPIREDDATE`,`LO_ACTIVEIND_ID`,`LO_CREATEDBY`,
				`LO_CREATEDATE`,`LO_UPDATEBY`,`LO_UPDATEDATE`)
				VALUES(l_master_id, state_id, district_id, lottyp_id, lotnum, altlotnum, title_type_id, lottitlenum,
		 alttitlenum, landar, unit_id, landcond_id, landpos_id, roadtype_id, roadcategory_id, landuse_id, expresscond,
		 interest, tenanttype_id,  st_tenstartdt, st_tenenddt, landstatus_id,p_user,now(),p_user, now());
			end if;
		end if;
    end if;
    SELECT i + 1 INTO i;
END WHILE;

RETURN 1;
END$$
DELIMITER ;

DELIMITER $$
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
		 set l_acc_no = acc_no;
        
    SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgstatus')))) INTO bldgtype; 
    
	select tdi_key into bldgtype_id from tbdefitems where tdi_td_name = 'ISHASBUILDING' and tdi_value = bldgtype;
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
END$$
DELIMITER ;
