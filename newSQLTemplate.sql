/**
 * Prevent loop
 */
CREATE PROCEDURE `pro_auth_item_child_prevent_circular` (IN in_parent_varchar VARCHAR(64), IN in_child_varchar VARCHAR(64))
BEGIN
	# variable declarations section
	DECLARE varchar_parent VARCHAR(64);
	DECLARE	dummy int;
    DECLARE no_more_rows INT;  

    # cursor declaration section

    #  get list of parent duty steps
    DECLARE cursor_parents CURSOR FOR 
        SELECT `parent` FROM `tbl_auth_item_child` WHERE `child` = in_parent_varchar; 

	# handler declaration section
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET no_more_rows = TRUE;

    # processing section

	# if we have an endless loop
	IF in_parent_varchar = in_child_varchar THEN
		# force an error
		SELECT 'sdfgdfg' INTO dummy 
		FROM tbl_account
		WHERE forced_trigger_error.`Circular reference`=NEW.id;
	END IF;

	# loop 
	OPEN cursor_parents;
	loop_parents: LOOP

		FETCH cursor_parents INTO
			varchar_parent;

		IF no_more_rows THEN
			SET no_more_rows = FALSE;
			CLOSE cursor_parents;
			LEAVE loop_parents;
		END IF;

		# Recurse thru all parents
		CALL pro_auth_item_child_prevent_circular(varchar_parent, in_child_varchar);

	END LOOP; # end loop thru custom values
END
