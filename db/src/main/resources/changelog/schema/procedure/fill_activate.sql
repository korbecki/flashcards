CREATE FUNCTION fill_activate() RETURNS TRIGGER
language plpgsql
as $$
DECLARE
    v_id integer;
BEGIN

    INSERT INTO activate(is_activated, status) VALUES (false, 'NEW') RETURNING activate_id INTO v_id;
    UPDATE system_user SET activate_id = v_id WHERE user_id = NEW.user_id;
    RETURN NEW;
end;$$;