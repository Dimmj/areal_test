create database areal_test;

CREATE TABLE IF NOT EXISTS public.departments
(
    id_department serial PRIMARY KEY NOT NULL,
    department character varying NOT NULL
);

CREATE TABLE IF NOT EXISTS public.positions
(
    id_position serial PRIMARY KEY NOT NULL,
    position_name character varying NOT NULL
);

CREATE TABLE IF NOT EXISTS public.employees
(
    id_employee serial PRIMARY KEY NOT NULL,
    surname character varying NOT NULL,
    name_emp character varying NOT NULL,
    patronymic character varying NOT NULL,
    passport_serial_number integer NOT NULL,
    passport_number integer NOT NULL UNIQUE,
    email character varying NOT NULL UNIQUE,
    address character varying NOT NULL,
    department integer NOT NULL REFERENCES departments(id_department),
    position_emp integer NOT NULL REFERENCES positions(id_position),
    salary float4 NOT NULL,
    hired date NOT NULL,
    is_fired boolean NOT NULL
);