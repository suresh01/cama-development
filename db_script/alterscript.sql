ALTER TABLE `cama`.`cm_appln_val` 
ADD INDEX `idx` (`va_vt_id` ASC, `va_id` ASC);
;

ALTER TABLE `cama`.`cm_appln_valterm` 
ADD INDEX `idx` (`vt_id` ASC);
;

ALTER TABLE `cama`.`cm_appln_valdetl` 
ADD INDEX `accno_idx` (`vd_accno` ASC);
;

CREATE  VIEW `v_activeterm` AS select `cm_appln_valdetl`.`vd_accno` 
AS `accno`,max(`cm_appln_valterm`.`vt_termDate`) AS `termdate`,count(`cm_appln_bldg`.`ab_id`) AS `bldgcount` 
from (((`cm_appln_valdetl` join `cm_appln_val` on((`cm_appln_val`.`va_id` = `cm_appln_valdetl`.`vd_va_id`))) 
join `cm_appln_valterm` on((`cm_appln_valterm`.`vt_id` = `cm_appln_val`.`va_vt_id`))) 
left join `cm_appln_bldg` on((`cm_appln_bldg`.`ab_vd_id` = `cm_appln_valdetl`.`vd_id`))) 
where (`cm_appln_valterm`.`vt_approvalstatus_id` = '05') group by `cm_appln_valdetl`.`vd_accno`;
