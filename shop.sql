
CREATE TABLE public.logo (
    id_logo integer NOT NULL,
    url_logo character varying
);

ALTER TABLE public.logo OWNER TO pi;


CREATE TABLE public.persona (
    id_persona integer NOT NULL,
    nombre character varying,
    apellidos character varying,
    rut character varying,
    rfid character varying,
    url_foto character varying
);

ALTER TABLE public.persona OWNER TO pi;


CREATE TABLE public.registros (
    id_registro integer NOT NULL,
    fecha timestamp without time zone,
    temperatura numeric,
    tambiente numeric,
    rfid character varying,
    cod_error integer
);

ALTER TABLE public.registros OWNER TO pi;


CREATE TABLE public.totem (
    id_totem integer NOT NULL,
    codigo character varying,
    descripcion character varying,
    direccion character varying
);


ALTER TABLE public.totem OWNER TO pi;


CREATE TABLE public.video (
    id_video integer NOT NULL,
    url_video character varying
);

ALTER TABLE public.video OWNER TO pi;


ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_rfid_key UNIQUE (rfid);

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_rut_key UNIQUE (rut);

ALTER TABLE ONLY public.registros
    ADD CONSTRAINT pk PRIMARY KEY (id_registro);

ALTER TABLE ONLY public.logo
    ADD CONSTRAINT pk_logo PRIMARY KEY (id_logo);

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT pk_persona PRIMARY KEY (id_persona);

ALTER TABLE ONLY public.totem
    ADD CONSTRAINT pk_totem PRIMARY KEY (id_totem);


ALTER TABLE ONLY public.video
    ADD CONSTRAINT pkkk PRIMARY KEY (id_video);


ALTER TABLE ONLY public.totem
    ADD CONSTRAINT totem_codigo_key UNIQUE (codigo);
