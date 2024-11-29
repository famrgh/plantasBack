-- public.especie_id_seq definition

-- DROP SEQUENCE public.especie_id_seq;

CREATE SEQUENCE public.especie_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.familia_id_seq definition

-- DROP SEQUENCE public.familia_id_seq;

CREATE SEQUENCE public.familia_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.foto_categoria_id_seq definition

-- DROP SEQUENCE public.foto_categoria_id_seq;

CREATE SEQUENCE public.foto_categoria_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.foto_id_seq definition

-- DROP SEQUENCE public.foto_id_seq;

CREATE SEQUENCE public.foto_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.genero_id_seq definition

-- DROP SEQUENCE public.genero_id_seq;

CREATE SEQUENCE public.genero_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.planta_foto_id_seq definition

-- DROP SEQUENCE public.planta_foto_id_seq;

CREATE SEQUENCE public.planta_foto_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.planta_id_seq definition

-- DROP SEQUENCE public.planta_id_seq;

CREATE SEQUENCE public.planta_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;


-- public.plantaespecie_id_seq definition

-- DROP SEQUENCE public.plantaespecie_id_seq;

CREATE SEQUENCE public.plantaespecie_id_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;



--------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------


-- public.especies definition

-- Drop table

-- DROP TABLE public.especies;

CREATE TABLE public.especies (
	id int4 NOT NULL DEFAULT nextval('especie_id_seq'::regclass),
	nombre varchar NOT NULL,
	baja bool NULL DEFAULT false,
	CONSTRAINT especie_pk PRIMARY KEY (id)
);


-- public.fotos definition

-- Drop table

-- DROP TABLE public.fotos;

CREATE TABLE public.fotos (
	id int4 NOT NULL DEFAULT nextval('foto_id_seq'::regclass),
	url varchar NOT NULL,
	descripcion varchar NULL,
	baja bool NULL DEFAULT false,
	fecha timestamp NOT NULL DEFAULT now(),
	CONSTRAINT foto_pk PRIMARY KEY (id)
);


-- public.fotos_categorias definition

-- Drop table

-- DROP TABLE public.fotos_categorias;

CREATE TABLE public.fotos_categorias (
	id int4 NOT NULL DEFAULT nextval('foto_categoria_id_seq'::regclass),
	CONSTRAINT foto_categoria_pk PRIMARY KEY (id)
);


-- public.plantas definition

-- Drop table

-- DROP TABLE public.plantas;

CREATE TABLE public.plantas (
	id int4 NOT NULL DEFAULT nextval('planta_id_seq'::regclass),
	codigo int4 NOT NULL,
	baja bool NOT NULL DEFAULT false,
	CONSTRAINT planta_pk PRIMARY KEY (id)
);


-- public.generos definition

-- Drop table

-- DROP TABLE public.generos;

CREATE TABLE public.generos (
	id int4 NOT NULL DEFAULT nextval('genero_id_seq'::regclass),
	nombre varchar NOT NULL,
	baja bool NULL DEFAULT false,
	CONSTRAINT genero_pk PRIMARY KEY (id),
	CONSTRAINT genero_especie_fk FOREIGN KEY (id) REFERENCES public.especies(id)
);


-- public.plantas_especies definition

-- Drop table

-- DROP TABLE public.plantas_especies;

CREATE TABLE public.plantas_especies (
	id int4 NOT NULL DEFAULT nextval('plantaespecie_id_seq'::regclass),
	CONSTRAINT plantaespecie_pk PRIMARY KEY (id),
	CONSTRAINT plantaespecie_especie_fk FOREIGN KEY (id) REFERENCES public.especies(id),
	CONSTRAINT plantaespecie_planta_fk FOREIGN KEY (id) REFERENCES public.plantas(id)
);


-- public.plantas_fotos definition

-- Drop table

-- DROP TABLE public.plantas_fotos;

CREATE TABLE public.plantas_fotos (
	id int4 NOT NULL DEFAULT nextval('planta_foto_id_seq'::regclass),
	baja bool NOT NULL DEFAULT false,
	CONSTRAINT planta_foto_pk PRIMARY KEY (id),
	CONSTRAINT planta_foto_foto_categoria_fk FOREIGN KEY (id) REFERENCES public.fotos_categorias(id),
	CONSTRAINT planta_foto_foto_fk FOREIGN KEY (id) REFERENCES public.fotos(id),
	CONSTRAINT planta_foto_planta_fk FOREIGN KEY (id) REFERENCES public.plantas(id)
);


-- public.familias definition

-- Drop table

-- DROP TABLE public.familias;

CREATE TABLE public.familias (
	id int4 NOT NULL DEFAULT nextval('familia_id_seq'::regclass),
	nombre varchar NOT NULL,
	baja bool NULL DEFAULT false,
	CONSTRAINT familia_pk PRIMARY KEY (id),
	CONSTRAINT familia_genero_fk FOREIGN KEY (id) REFERENCES public.generos(id)
);
