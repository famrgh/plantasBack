-- public.familias definition

-- Drop table

-- DROP TABLE public.familias;

CREATE TABLE public.familias (
	id int4 NOT NULL DEFAULT nextval('familia_id_seq'::regclass),
	nombre varchar NOT NULL,
	baja bool NULL DEFAULT false,
	CONSTRAINT familia_pk PRIMARY KEY (id),
	CONSTRAINT familias_un UNIQUE (nombre)
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
	id_familia int4 NULL,
	CONSTRAINT genero_pk PRIMARY KEY (id),
	CONSTRAINT generos_familias_fk FOREIGN KEY (id_familia) REFERENCES public.familias(id)
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


-- public.especies definition

-- Drop table

-- DROP TABLE public.especies;

CREATE TABLE public.especies (
	id int4 NOT NULL DEFAULT nextval('especie_id_seq'::regclass),
	nombre varchar NOT NULL,
	baja bool NULL DEFAULT false,
	id_genero int4 NULL,
	CONSTRAINT especie_pk PRIMARY KEY (id),
	CONSTRAINT especies_generos_fk FOREIGN KEY (id_genero) REFERENCES public.generos(id)
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