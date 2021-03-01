DROP PROCEDURE `cama`.`proc_approvepropreg`;

DELIMITER $$
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
	select count(*) into l_count from cm_appln_val where va_id = p_baskedid and va_approved= '04';
	if l_count = 1 then
		update cm_appln_valdetl set vd_approvalstatus_id= '07', vd_approvalstatusby = p_username 
        where vd_va_id = p_baskedid;
		update cm_appln_val set va_approved= '05', va_approvedby = p_username, va_approvedate = NOW() where va_id = p_baskedid;
	end if;
end if;

if p_module = 'objection' then
	
	
		update cm_appln_valdetl set vd_approvalstatus_id= '14', vd_approvalstatusby = p_username 
        where vd_va_id = p_baskedid;
		update cm_appln_val set va_approved= '14', va_approvedby = p_username, va_approvedate = NOW() where va_id = p_baskedid;
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

		  
		  select va_approved into basket_stage from cm_appln_val inner join cm_appln_valdetl on vd_va_id = va_id
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
			update cm_appln_val set va_approved = '06' where va_id = (select vd_va_id from cm_appln_valdetl where vd_id = _value );
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
		update cm_appln_val set va_approved = '11' where va_id = p_baskedid;
		update cm_appln_valterm set vt_approvalstatus_id = '02' where vt_id in(select va_vt_id from cm_appln_val
        where va_id = p_baskedid);
    end if;
    if applntype = 'K' then
	update cm_appln_val set va_approved = '08' where va_id = p_baskedid;
	update cm_appln_valdetl set vd_approvalstatus_id = '11' where vd_va_id = p_baskedid;
        select va_vt_id into termid from cm_appln_val where va_id = p_baskedid;
        select count(*) into l_count from cm_objection where ob_vt_id = termid;
        if l_count = 0 then
			select YEAR(vt_termDate), vt_approvalstatusdate,vt_name into termDatenum, enforceDate,termdesc from cm_appln_valterm where vt_id = termid;
			INSERT INTO `cm_objection`(`ob_vt_id`,ob_listyear,ob_enforcedate,ob_desc,`ob_createby`,`ob_createdate`,`ob_updateby`,`ob_updatedate`)
			VALUES(termid,termDatenum,enforceDate,termdesc,
            p_username, now(), p_username, now());
		end if;
        
        BEGIN
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
				
		  
	END;
    
    end if;
end if;


if p_module = 'ENFORCE' then
	update cm_appln_valterm set vt_transferby = p_username, vt_transferDate =now(), vt_approvalstatus_id = '05' where vt_id = p_baskedid;
end if;


if p_module = 'planapprove1' then
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
    select p_param,p_status;
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

END$$
DELIMITER ;
