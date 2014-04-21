ALTER TABLE Antibiotic ADD antibiotic_order INT DEFAULT NULL;
ALTER TABLE CytologyGeneralTest ADD cytology_general_source VARCHAR(255) DEFAULT NULL;
select @ordval := 0;
update Antibiotic set `antibiotic_order` = 
        (select @ordval := @ordval + 1) order by antibiotic_name;
