


CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `view_lieu_complete` AS
    select 
        *,
        (select 
                count(`eve_int_id`)
            from
                `eve_evenements`
            where
                (`eve_lieu_int_id` = `org_organisateurs`.`org_int_id`)
            group by `org_organisateurs`.`org_int_id`) AS `nbEvent`
    from
        (((`org_organisateurs`
        join `mde_mapdepartement`)
        join `mre_mapregion`)
        join `pla_places`)
    where
        ((`org_organisateurs`.`org_pla_int_id` = `pla_places`.`pla_int_id`)
            and (substr(`pla_places`.`pla_int_cp`, 1, 2) = `mde_mapdepartement`.`mapDepartementCode`)
            and (`mre_mapregion`.`mapRegionId` = `mde_mapdepartement`.`mapDepartementRegionId`))

