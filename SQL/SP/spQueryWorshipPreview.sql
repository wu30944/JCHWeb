-- 如果存在時先刪除 PROCEDURE
DROP PROCEDURE IF EXISTS spQueryWorshipPreview;
DELIMITER //

CREATE PROCEDURE spQueryWorshipPreview(IN strSubject varchar(50),IN strSpeaker varchar(30),IN strSdate DATE,IN strEdate date,IN strLanguage_type varchar(10))
BEGIN
 		call spSplit(strLanguage_type,',');
 		
 		select sp.*,cod.cod_val from sunday_preview sp
 		inner join codtbld cod
 		on sp.language_type=cod.cod_id
 		and cod.cod_type='language'
 		where (sp.subject like  CONCAT('%',strSubject,'%') or strSubject = '')
 		and (sp.speaker like CONCAT('%',strSpeaker,'%') or strSpeaker = '')
 		and (sp.date between strSdate and strEdate)
 		and (exists (select 1 from tbl_List tl
 						where tl.COD=sp.language_type) or strLanguage_type = '');
 		
 		
        drop table tbl_List;
END//

DELIMITER ;