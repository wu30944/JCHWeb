-- 如果存在時先刪除 PROCEDURE
DROP PROCEDURE IF EXISTS spSplit;
DELIMITER //

CREATE PROCEDURE spSplit(IN sInputString varchar(1000),IN sSplitChar varchar(800))
BEGIN
  DECLARE x INT DEFAULT 0;
       	    DECLARE	lInputStringLength	Int DEFAULT 0;
			DECLARE	lPosition Int DEFAULT 0;
			DECLARE	lSplitChar	Int DEFAULT 0;
            
            CREATE TEMPORARY TABLE tbl_List(
           SEQ   INT NOT NULL AUTO_INCREMENT,
            COD  VARCHAR(800)  NOT NULL,			
             PRIMARY KEY(SEQ)	
       );
            SET lInputStringLength = length( sInputString );
	SET lPosition=1;
	SET lSplitChar=1;

		WHILE lPosition <= lInputStringLength DO
        	SET lSplitChar = locate( sSplitChar , sInputString , lPosition);

            IF lSplitChar = 0 then
					INSERT  tbl_List (COD )
					select  SUBSTRING( sInputString , lPosition ,1+ lInputStringLength - lPosition);
					SET lPosition= lInputStringLength + 1;	
			ELSE
					INSERT tbl_List ( COD )
					SELECT SUBSTRING( sInputString , lPosition , lSplitChar - lPosition);
					              
					SET lPosition = lSplitChar+1;
              end IF;

        end WHILE;

END//

DELIMITER ;