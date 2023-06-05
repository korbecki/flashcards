CREATE TRIGGER system_user_activate AFTER INSERT
    ON system_user
    FOR EACH ROW
    EXECUTE PROCEDURE fill_activate(user_id);