use info2;

insert into artists (name, created_at, updated_at) values('Ayreon', LOCALTIME(), LOCALTIME());
insert into artists (name, created_at, updated_at) values('Rammstein',LOCALTIME(), LOCALTIME());
insert into artists (name, created_at, updated_at) values('Raubtier',LOCALTIME(), LOCALTIME());
insert into artists (name, created_at, updated_at) values('Shylamgognar',LOCALTIME(), LOCALTIME());
insert into artists (name, created_at, updated_at) values('HUN test',LOCALTIME(), LOCALTIME());


insert into albums (title, release_date, artist_id, pic_url, created_at, updated_at) values('The Source', 2017, 1, 'the_source.jpg',LOCALTIME(), LOCALTIME());
insert into albums (title, release_date, artist_id, created_at, updated_at) values('The Human Equeation', 2004, 1,LOCALTIME(), LOCALTIME());
insert into albums (title, release_date, artist_id, created_at, updated_at) values('Deutchland', 2019, 2,LOCALTIME(), LOCALTIME());
insert into albums (title, release_date, artist_id, created_at, updated_at) values('Från Norrland Till Helvetets Port', 2012, 3 ,LOCALTIME(), LOCALTIME());
insert into albums (title, release_date, artist_id, pic_url, created_at, updated_at) values('Transience', 2018, 4, 'transience.jpg',LOCALTIME(), LOCALTIME());
insert into albums (title, release_date, artist_id, pic_url, created_at, updated_at) values('Emergence', 2014, 4, 'emergence.jpg',LOCALTIME(), LOCALTIME());
insert into albums (title, release_date, artist_id, created_at, updated_at) values('Árvíztűrő tükörfúrógép', 2019, 5,LOCALTIME(), LOCALTIME());

insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Transience', 7, 1, 12*60+10,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('The Dawn of Motion', 7, 2, 7*60+46,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('As All Must Come to Pass', 7, 3, 7*60+07,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('This Shadow of the Heart', 7, 4, 4*60+09,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('The Chosen Path', 7, 5, 6*60+02,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('No Child of Man Could Follow', 7, 6, 12*60+00,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Life', 7, 8, 13*60+30,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Journey Through the Fog', 7, 7, 10*60+09,LOCALTIME(), LOCALTIME());

insert into songs (title, album_id, number_of, length, created_at, updated_at) values('I Am the Abyss', 8, 1, 8*60+50,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Emergence', 8, 2, 6*60+27,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Edin in Ashes', 8, 3, 6*60+19,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('This World Shall Fall', 8, 4, 3*60+28,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Squandered Paradise', 8, 5, 4*60+24,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Eternal Forest', 8, 6, 4*60+22,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('The Cosmic Tide', 8, 7, 6*60+37,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('A New Dawn', 8, 8, 6*60+37,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('The Sun No Longer', 8, 9, 4*60+26,LOCALTIME(), LOCALTIME());

insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Deutchland', 3, 1, 5*60+22,LOCALTIME(), LOCALTIME());

insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Sveriges Elit', 4, 1, 3*60+55,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Apokalyps', 4, 2, 2*60+43,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Besten I Mig', 4, 3, 3*60+21,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Låt Napalmen Regna', 4, 4, 3*60+24,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Allt Förlorat', 4, 5, 3*60+38,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Kamouflage', 4, 6, 4*60+15,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Fafnesbane', 4, 7, 3*60+1,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Vittring', 4, 8, 3*60+28,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Dit Vinden Bär', 4, 9, 4*60+19,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Rebeller', 4, 10, 3*60+14,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Vapenbröder', 4, 11, 3*60+6,LOCALTIME(), LOCALTIME());
insert into songs (title, album_id, number_of, length, created_at, updated_at) values('Förgätmigej', 4, 12, 4*60+1,LOCALTIME(), LOCALTIME());

insert into songs (title, album_id, number_of, length, created_at, updated_at) values('TEST', 7, 1, 1,LOCALTIME(), LOCALTIME());