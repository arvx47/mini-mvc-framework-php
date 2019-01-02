/* ---------------------------------------------------------------------- */
/* Script generated with: DeZign for Databases V7.3.4                     */
/* Target DBMS:           PostgreSQL 9                                    */
/* Project file:          Project1.dez                                    */
/* Project name:                                                          */
/* Author:                                                                */
/* Script type:           Database creation script                        */
/* Created on:            2018-11-19 18:08                                */
/* ---------------------------------------------------------------------- */


/* ---------------------------------------------------------------------- */
/* Tables                                                                 */
/* ---------------------------------------------------------------------- */

/* ---------------------------------------------------------------------- */
/* Add table "usuarios"                                                   */
/* ---------------------------------------------------------------------- */

CREATE TABLE usuarios (
    id SERIAL  NOT NULL,
    nombre CHARACTER VARYING(250)  NOT NULL,
    apellido CHARACTER VARYING(250)  NOT NULL,
    usuario CHARACTER VARYING(15)  NOT NULL,
    password CHARACTER VARYING(250)  NOT NULL,
    CONSTRAINT PK_usuarios PRIMARY KEY (id)
);
