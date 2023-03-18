PGDMP     "                    {         
   spp_ujikom    14.4    14.4 3    >           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            @           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            A           1262    24576 
   spp_ujikom    DATABASE     j   CREATE DATABASE spp_ujikom WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Indonesia.1252';
    DROP DATABASE spp_ujikom;
                postgres    false            �            1259    24654    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    24653    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    215            B           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    214            �            1259    24634    users    TABLE     s  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    role character varying(255) DEFAULT 'siswa'::character varying NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['administrator'::character varying, 'petugas'::character varying, 'siswa'::character varying])::text[])))
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    24633    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    212            C           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    211            �            1259    24696    kelas    TABLE        CREATE TABLE public.kelas (
    id_kelas bigint DEFAULT nextval('public.users_id_seq'::regclass) NOT NULL,
    nama_kelas character varying(10),
    kompetensi_keahlian character varying(50),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.kelas;
       public         heap    postgres    false    211            �            1259    24627 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    24626    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    210            D           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    209            �            1259    24646    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    24678 
   pembayaran    TABLE     �  CREATE TABLE public.pembayaran (
    id bigint DEFAULT nextval('public.users_id_seq'::regclass) NOT NULL,
    id_petugas bigint,
    nisn bigint NOT NULL,
    tgl_bayar character varying(255) NOT NULL,
    bulan_dibayar character varying(8) NOT NULL,
    tahun_dibayar character varying(4) NOT NULL,
    id_spp bigint,
    jumlah_bayar bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    for_month bigint DEFAULT 0
);
    DROP TABLE public.pembayaran;
       public         heap    postgres    false    211            �            1259    24666    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    24665    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    217            E           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    216            �            1259    24684    siswa    TABLE     �  CREATE TABLE public.siswa (
    nisn bigint NOT NULL,
    nis character varying(8),
    nama character varying(35),
    id_kelas bigint,
    alamat text,
    no_telp character varying(13),
    id_spp bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    nominal_bayar bigint,
    status_bayar bigint DEFAULT 0,
    user_id bigint
);
    DROP TABLE public.siswa;
       public         heap    postgres    false            �            1259    24691    spp    TABLE     �   CREATE TABLE public.spp (
    id_spp bigint DEFAULT nextval('public.users_id_seq'::regclass) NOT NULL,
    tahun bigint,
    nominal bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.spp;
       public         heap    postgres    false    211            �           2604    24657    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214    215                       2604    24630    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    209    210    210            �           2604    24669    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    217    217            �           2604    24637    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    212    212            5          0    24654    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    215   B@       ;          0    24696    kelas 
   TABLE DATA           b   COPY public.kelas (id_kelas, nama_kelas, kompetensi_keahlian, created_at, updated_at) FROM stdin;
    public          postgres    false    221   _@       0          0    24627 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    210   �@       3          0    24646    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    213   iA       8          0    24678 
   pembayaran 
   TABLE DATA           �   COPY public.pembayaran (id, id_petugas, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar, created_at, updated_at, for_month) FROM stdin;
    public          postgres    false    218   �A       7          0    24666    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    217   $B       9          0    24684    siswa 
   TABLE DATA           �   COPY public.siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp, created_at, updated_at, nominal_bayar, status_bayar, user_id) FROM stdin;
    public          postgres    false    219   AB       :          0    24691    spp 
   TABLE DATA           M   COPY public.spp (id_spp, tahun, nominal, created_at, updated_at) FROM stdin;
    public          postgres    false    220   FC       2          0    24634    users 
   TABLE DATA           {   COPY public.users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    212   �C       F           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    214            G           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 4, true);
          public          postgres    false    209            H           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    216            I           0    0    users_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.users_id_seq', 109, true);
          public          postgres    false    211            �           2606    24662    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    215            �           2606    24664 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    215            �           2606    24701    kelas kelas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pkey PRIMARY KEY (id_kelas);
 :   ALTER TABLE ONLY public.kelas DROP CONSTRAINT kelas_pkey;
       public            postgres    false    221            �           2606    24632    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    210            �           2606    24652 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    213            �           2606    24683    pembayaran pembayaran_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.pembayaran
    ADD CONSTRAINT pembayaran_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_pkey;
       public            postgres    false    218            �           2606    24673 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    217            �           2606    24676 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    217            �           2606    24712    siswa siswa_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.siswa
    ADD CONSTRAINT siswa_pkey PRIMARY KEY (nisn);
 :   ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_pkey;
       public            postgres    false    219            �           2606    24695    spp spp_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.spp
    ADD CONSTRAINT spp_pkey PRIMARY KEY (id_spp);
 6   ALTER TABLE ONLY public.spp DROP CONSTRAINT spp_pkey;
       public            postgres    false    220            �           2606    24645    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    212            �           2606    24643    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    212            �           1259    24674 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    217    217            5      x������ � �      ;   r   x�36�
�Q���T0�J�N�L,NTH-J�K�N,Q�)�K��4202�50�54W00�21�20�&�ej7͘�,��ͭLL��q�Z�M3!�4K+cTӌ�L�n3����� ��:�      0   x   x�]�A
�0E��a$�л�i�54��x}�k��_����� �9�Jm��XM��A\�e���Y�JcC+7Ϋ��������	�2�x\��.����2k��D���i�{�f@�      3      x������ � �      8   �   x�m���0�o<EH���,���Ȗ��+sVvACb�+ #K�@x��>QN��0P�z�Q#��~���y����S�{t����u��4���G�י��K�['�%�m��l�Vf��s�c=�עG�2��~��>'�G�      7      x������ � �      9   �   x�u��N�@E��W�]�;��.!�P�`ӍQS)jHPB�{&�P��}WW���<ز�,BO��-	�VmM�V�)w}�W�v��@|�P�����,�F�y�ɹB+X^������"]U�ݞ�kO��&�?;�H\��`�;�n������AG5�U;�7��f3��ļg~��fԯ.'P<��h,�Zh��6��]��c�g�����:%���r�'��$&ڬ	��\E�	u/_�      :   ,   x�36�4202�44 0G��X��\���������W� O�
�      2     x�u�I��0���+\�mB\=Dqb���7�D�b��n�T]���{���9'Wָ��U����#JMz�Kʽ�\Wn����p��z-'��Llo]���xW7,���P��[�I�#E5s-��?�>�(��HjG��:�`��-ѹ3Be����� ��q�4�i�3צu�^��F*��^(4ďYzٽe�ME�l�/'�k���1m��8�S�=wkz ,�}�ӗ���^$2�M�JЧL��9#��!w|y<�-J��k9HZ�!�\T�����N+�,���5�>@b6�,��9�jE�so*�tg���	%�l���}�|�J.�b�1�NPV�d%w|����!
ӄ��Ҕu,>�,�|⻾�9k�r4�'�U�vji�a^L�7l������ �Qic<���P�ܭM��Xn<�wp-�i/�Ȱ��8Ƅ����N��_ah��~?��p���5Co�N�p�����Q&�$�ڡ8]G��j�v�j�m�@��4�j*�����y�';��     