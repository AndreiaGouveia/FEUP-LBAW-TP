ALTER TABLE question ADD COLUMN tsv tsvector;

CREATE INDEX tsv_idx ON question USING gin(tsv);

CREATE FUNCTION question_search_trigger() RETURNS trigger AS $$
begin
  new.tsv :=
    setweight(to_tsvector(coalesce(new.title,'')), 'A') ||
    setweight(to_tsvector(coalesce((select description
									from publication
									where publication.id = new.id_commentable_publication ),'')), 'D');
  return new;
end
$$ LANGUAGE plpgsql;

CREATE TRIGGER tsvectorupdate BEFORE INSERT OR UPDATE
ON question FOR EACH ROW EXECUTE PROCEDURE question_search_trigger();

INSERT INTO publication (id_owner, description)
VALUES
    (2, 'OLA');

INSERT INTO commentable_publication
VALUES(12);

INSERT INTO question
VALUES
    (12, 'Porque é que o meu gato é tão gordo? Ele só come 2kgs de comida por dia. Porfavor, ajudem!');