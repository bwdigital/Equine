ALTER TABLE Antibiotic ADD antibiotic_order INT DEFAULT NULL;
select @ordval := 0;
update Antibiotic set `antibiotic_order` = 
        (select @ordval := @ordval + 1) order by antibiotic_name;