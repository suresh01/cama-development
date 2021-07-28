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
    set @result = pr_lot_register(master_param, p_user,'','');
    set @result = pr_owner_register(master_param, p_user,'','');
    set @result = pr_bldg_register(master_param, p_user,'','');
    set @result = pr_bldg_area_register(master_param, p_user,'','');
    
    
END