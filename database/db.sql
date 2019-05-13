use info2;

insert into artists (name) values('Ayreon');
insert into artists (name) values('Rammstein');
insert into artists (name) values('Freedom Call');
insert into artists (name) values('Shylamgognar');
insert into artists (name) values('Ana');

insert into albums (title, release_date, artist_id, pic_url) values('The Source', 2017, 1, 'the_source.jpg');
insert into albums (title, release_date, artist_id) values('The Human Equeation', 2004, 1);

insert into albums (title, release_date, artist_id) values('Deutchland', 2019, 2);

insert into albums (title, release_date, artist_id) values('Master of Light', 2016, 3);
insert into albums (title, release_date, artist_id) values('Beyound', 2014, 3);
insert into albums (title, release_date, artist_id) values('Hammer of the God', 2016, 3);

insert into albums (title, release_date, artist_id, pic_url) values('Transience', 2018, 4, 'transience.jpg');
insert into albums (title, release_date, artist_id, pic_url) values('Emergence', 2014, 4, 'emergence.jpg');

insert into songs (title, album_id, number_of, length) values('Transience', 7, 1, 12*60+10);
insert into songs (title, album_id, number_of, length) values('The Dawn of Motion', 7, 2, 7*60+46);
insert into songs (title, album_id, number_of, length) values('As All Must Come to Pass', 7, 3, 7*60+07);
insert into songs (title, album_id, number_of, length) values('This Shadow of the Heart', 7, 4, 4*60+09);
insert into songs (title, album_id, number_of, length) values('The Chosen Path', 7, 5, 6*60+02);
insert into songs (title, album_id, number_of, length) values('No Child of Man Could Follow', 7, 6, 12*60+00);
insert into songs (title, album_id, number_of, length) values('Life', 7, 8, 13*60+30);
insert into songs (title, album_id, number_of, length) values('Journey Through the Fog', 7, 7, 10*60+09);


insert into songs (title, album_id, number_of, length) values('I Am the Abyss', 8, 1, 8*60+50);
insert into songs (title, album_id, number_of, length) values('Emergence', 8, 2, 6*60+27);
insert into songs (title, album_id, number_of, length) values('Edin in Ashes', 8, 3, 6*60+19);
insert into songs (title, album_id, number_of, length) values('This World Shall Fall', 8, 4, 3*60+28);
insert into songs (title, album_id, number_of, length) values('Squandered Paradise', 8, 5, 4*60+24);
insert into songs (title, album_id, number_of, length) values('Eternal Forest', 8, 6, 4*60+22);
insert into songs (title, album_id, number_of, length) values('The Cosmic Tide', 8, 7, 6*60+37);
insert into songs (title, album_id, number_of, length) values('A New Dawn', 8, 8, 6*60+37);
insert into songs (title, album_id, number_of, length) values('The Sun No Longer', 8, 9, 4*60+26);