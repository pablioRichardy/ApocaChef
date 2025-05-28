--
-- PostgreSQL database dump
--

-- Dumped from database version 15.13 (Debian 15.13-1.pgdg120+1)
-- Dumped by pg_dump version 15.13 (Debian 15.13-1.pgdg120+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: ingredientes; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.ingredientes (
    id integer NOT NULL,
    nome character varying(100) NOT NULL
);


ALTER TABLE public.ingredientes OWNER TO "user";

--
-- Name: ingredientes_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.ingredientes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ingredientes_id_seq OWNER TO "user";

--
-- Name: ingredientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.ingredientes_id_seq OWNED BY public.ingredientes.id;


--
-- Name: receita_ingrediente; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.receita_ingrediente (
    receita_id integer NOT NULL,
    ingrediente_id integer NOT NULL
);


ALTER TABLE public.receita_ingrediente OWNER TO "user";

--
-- Name: receitas; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.receitas (
    id integer NOT NULL,
    titulo character varying(100) NOT NULL,
    descricao text,
    imagem character varying(255),
    dificuldade character varying(10) NOT NULL,
    tempo_preparo integer,
    CONSTRAINT receitas_dificuldade_check CHECK (((dificuldade)::text = ANY ((ARRAY['Fácil'::character varying, 'Média'::character varying, 'Difícil'::character varying])::text[])))
);


ALTER TABLE public.receitas OWNER TO "user";

--
-- Name: receitas_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.receitas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.receitas_id_seq OWNER TO "user";

--
-- Name: receitas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.receitas_id_seq OWNED BY public.receitas.id;


--
-- Name: ingredientes id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.ingredientes ALTER COLUMN id SET DEFAULT nextval('public.ingredientes_id_seq'::regclass);


--
-- Name: receitas id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.receitas ALTER COLUMN id SET DEFAULT nextval('public.receitas_id_seq'::regclass);


--
-- Data for Name: ingredientes; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.ingredientes (id, nome) FROM stdin;
\.


--
-- Data for Name: receita_ingrediente; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.receita_ingrediente (receita_id, ingrediente_id) FROM stdin;
\.


--
-- Data for Name: receitas; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.receitas (id, titulo, descricao, imagem, dificuldade, tempo_preparo) FROM stdin;
13	Sopa	Legumes cozidos	\N	Fácil	40
15	Pao	idfjopdifujpof	\N	Fácil	2
\.


--
-- Name: ingredientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.ingredientes_id_seq', 1, false);


--
-- Name: receitas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.receitas_id_seq', 15, true);


--
-- Name: ingredientes ingredientes_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.ingredientes
    ADD CONSTRAINT ingredientes_pkey PRIMARY KEY (id);


--
-- Name: receita_ingrediente receita_ingrediente_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.receita_ingrediente
    ADD CONSTRAINT receita_ingrediente_pkey PRIMARY KEY (receita_id, ingrediente_id);


--
-- Name: receitas receitas_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.receitas
    ADD CONSTRAINT receitas_pkey PRIMARY KEY (id);


--
-- Name: receita_ingrediente receita_ingrediente_ingrediente_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.receita_ingrediente
    ADD CONSTRAINT receita_ingrediente_ingrediente_id_fkey FOREIGN KEY (ingrediente_id) REFERENCES public.ingredientes(id) ON DELETE CASCADE;


--
-- Name: receita_ingrediente receita_ingrediente_receita_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.receita_ingrediente
    ADD CONSTRAINT receita_ingrediente_receita_id_fkey FOREIGN KEY (receita_id) REFERENCES public.receitas(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

