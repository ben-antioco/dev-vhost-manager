

help:
	@echo "--------------------------------------------------";
	@echo "@@@  @@@  @@@@@@@@  @@@       @@@@@@@";   
	@echo "@@@  @@@  @@@@@@@@  @@@       @@@@@@@@";  
	@echo "@@!  @@@  @@!       @@!       @@!  @@@";  
	@echo "!@!  @!@  !@!       !@!       !@!  @!@";  
	@echo "@!@!@!@!  @!!!:!    @!!       @!@@!@!";   
	@echo "!!!@!!!!  !!!!!:    !!!       !!@!!!";    
	@echo "!!:  !!!  !!:       !!:       !!:";       
	@echo ":!:  !:!  :!:        :!:      :!:";       
	@echo "::   :::   :: ::::   :: ::::   ::";       
	@echo " :   : :  : :: ::   : :: : :   :";   
	@echo "--------------------------------------------------";
	@echo 'du           - docker container up'
	@echo 'dd           - docker container down'
	@echo 'ddb          - docker container db connexion'
	@echo 'ddb-local    - install database without docker'
	@echo 'host         - add docker vhost in /etc/hosts'
	@echo 'watch        - run dev mode'
	@echo 'prod         - Pull and add asset to prod environment';
	@echo "ASCII : http://patorjk.com/software/taag/#p=display&f=Poison&t=test";
	@echo "--------------------------------------------------";
	@echo "--------------------------------------------------";


du: docker-up
docker-up:
	@echo "@@@@@@@    @@@@@@    @@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@      @@@  @@@  @@@@@@@";   
	@echo "@@@@@@@@  @@@@@@@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@@     @@@  @@@  @@@@@@@@";  
	@echo "@@!  @@@  @@!  @@@  !@@       @@!  !@@  @@!       @@!  @@@     @@!  @@@  @@!  @@@";  
	@echo "!@!  @!@  !@!  @!@  !@!       !@!  @!!  !@!       !@!  @!@     !@!  @!@  !@!  @!@";  
	@echo "@!@  !@!  @!@  !@!  !@!       @!@@!@!   @!!!:!    @!@!!@!      @!@  !@!  @!@@!@!";   
	@echo "!@!  !!!  !@!  !!!  !!!       !!@!!!    !!!!!:    !!@!@!       !@!  !!!  !!@!!!";    
	@echo "!!:  !!!  !!:  !!!  :!!       !!: :!!   !!:       !!: :!!      !!:  !!!  !!:";       
	@echo ":!:  !:!  :!:  !:!  :!:       :!:  !:!  :!:       :!:  !:!     :!:  !:!  :!:";       
	@echo " :::: ::  ::::: ::   ::: :::   ::  :::   :: ::::  ::   :::     ::::: ::   ::";       
	@echo ":: :  :    : :  :    :: :: :   :   :::  : :: ::    :   : :      : :  :    :";  

	docker-compose up -d --build

dd: docker-down
docker-down:
	@echo "@@@@@@@    @@@@@@    @@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@      @@@@@@@    @@@@@@   @@@  @@@  @@@  @@@  @@@";  
	@echo "@@@@@@@@  @@@@@@@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@@     @@@@@@@@  @@@@@@@@  @@@  @@@  @@@  @@@@ @@@";  
	@echo "@@!  @@@  @@!  @@@  !@@       @@!  !@@  @@!       @@!  @@@     @@!  @@@  @@!  @@@  @@!  @@!  @@!  @@!@!@@@";  
	@echo "!@!  @!@  !@!  @!@  !@!       !@!  @!!  !@!       !@!  @!@     !@!  @!@  !@!  @!@  !@!  !@!  !@!  !@!!@!@!";  
	@echo "@!@  !@!  @!@  !@!  !@!       @!@@!@!   @!!!:!    @!@!!@!      @!@  !@!  @!@  !@!  @!!  !!@  @!@  @!@ !!@!";  
	@echo "!@!  !!!  !@!  !!!  !!!       !!@!!!    !!!!!:    !!@!@!       !@!  !!!  !@!  !!!  !@!  !!!  !@!  !@!  !!!";  
	@echo "!!:  !!!  !!:  !!!  :!!       !!: :!!   !!:       !!: :!!      !!:  !!!  !!:  !!!  !!:  !!:  !!:  !!:  !!!";  
	@echo ":!:  !:!  :!:  !:!  :!:       :!:  !:!  :!:       :!:  !:!     :!:  !:!  :!:  !:!  :!:  :!:  :!:  :!:  !:!";  
	@echo " :::: ::  ::::: ::   ::: :::   ::  :::   :: ::::  ::   :::      :::: ::  ::::: ::   :::: :: :::    ::   ::";  
	@echo ":: :  :    : :  :    :: :: :   :   :::  : :: ::    :   : :     :: :  :    : :  :     :: :  : :    ::    :"; 

	docker-compose down

ddb: bash-db
bash-db:
	@echo "@@@@@@@    @@@@@@    @@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@      @@@@@@@   @@@@@@@";   
	@echo "@@@@@@@@  @@@@@@@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@@     @@@@@@@@  @@@@@@@@";  
	@echo "@@!  @@@  @@!  @@@  !@@       @@!  !@@  @@!       @@!  @@@     @@!  @@@  @@!  @@@";  
	@echo "!@!  @!@  !@!  @!@  !@!       !@!  @!!  !@!       !@!  @!@     !@!  @!@  !@   @!@";  
	@echo "@!@  !@!  @!@  !@!  !@!       @!@@!@!   @!!!:!    @!@!!@!      @!@  !@!  @!@!@!@";   
	@echo "!@!  !!!  !@!  !!!  !!!       !!@!!!    !!!!!:    !!@!@!       !@!  !!!  !!!@!!!!";  
	@echo "!!:  !!!  !!:  !!!  :!!       !!: :!!   !!:       !!: :!!      !!:  !!!  !!:  !!!";  
	@echo ":!:  !:!  :!:  !:!  :!:       :!:  !:!  :!:       :!:  !:!     :!:  !:!  :!:  !:!";  
	@echo " :::: ::  ::::: ::   ::: :::   ::  :::   :: ::::  ::   :::      :::: ::   :: ::::";  
	@echo ":: :  :    : :  :    :: :: :   :   :::  : :: ::    :   : :     :: :  :   :: : ::";  
	docker-compose exec db bash

ddb-local: 
	@echo "--------------------------------------------------";
	@echo "@@@  @@@  @@@   @@@@@@   @@@@@@@   @@@@@@   @@@       @@@        @@@@@@   @@@@@@@  @@@   @@@@@@   @@@  @@@";  
	@echo "@@@  @@@@ @@@  @@@@@@@   @@@@@@@  @@@@@@@@  @@@       @@@       @@@@@@@@  @@@@@@@  @@@  @@@@@@@@  @@@@ @@@";  
	@echo "@@!  @@!@!@@@  !@@         @@!    @@!  @@@  @@!       @@!       @@!  @@@    @@!    @@!  @@!  @@@  @@!@!@@@";  
	@echo "!@!  !@!!@!@!  !@!         !@!    !@!  @!@  !@!       !@!       !@!  @!@    !@!    !@!  !@!  @!@  !@!!@!@!";  
	@echo "!!@  @!@ !!@!  !!@@!!      @!!    @!@!@!@!  @!!       @!!       @!@!@!@!    @!!    !!@  @!@  !@!  @!@ !!@!";  
	@echo "!!!  !@!  !!!   !!@!!!     !!!    !!!@!!!!  !!!       !!!       !!!@!!!!    !!!    !!!  !@!  !!!  !@!  !!!";  
	@echo "!!:  !!:  !!!       !:!    !!:    !!:  !!!  !!:       !!:       !!:  !!!    !!:    !!:  !!:  !!!  !!:  !!!";  
	@echo ":!:  :!:  !:!      !:!     :!:    :!:  !:!   :!:       :!:      :!:  !:!    :!:    :!:  :!:  !:!  :!:  !:!";  
	@echo " ::   ::   ::  :::: ::      ::    ::   :::   :: ::::   :: ::::  ::   :::     ::     ::  ::::: ::   ::   ::";  
	@echo ":    ::    :   :: : :       :      :   : :  : :: : :  : :: : :   :   : :     :     :     : :  :   ::    :";   
	@echo "--------------------------------------------------";
	@echo "INSTALL MODE";
	@echo "--------------------------------------------------";

	mysql -h 127.0.0.1 -u root -p local_db && mysql -u root -p local_db < ./sql/local_db.sql

host:
	grep -q -F "vhostmanager.local" /etc/hosts || echo "127.0.0.1 vhostmanager.local" | sudo tee -a /etc/hosts

watch: 
	@echo "--------------------------------------------------";                                                                                                                             
	@echo "@@@@@@@   @@@@@@@@  @@@  @@@  @@@@@@@@  @@@        @@@@@@   @@@@@@@   @@@@@@@   @@@@@@@@  @@@@@@@@@@   @@@@@@@@  @@@  @@@  @@@@@@@";  
	@echo "@@@@@@@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@       @@@@@@@@  @@@@@@@@  @@@@@@@@  @@@@@@@@  @@@@@@@@@@@  @@@@@@@@  @@@@ @@@  @@@@@@@";  
	@echo "@@!  @@@  @@!       @@!  @@@  @@!       @@!       @@!  @@@  @@!  @@@  @@!  @@@  @@!       @@! @@! @@!  @@!       @@!@!@@@    @@!";    
	@echo "!@!  @!@  !@!       !@!  @!@  !@!       !@!       !@!  @!@  !@!  @!@  !@!  @!@  !@!       !@! !@! !@!  !@!       !@!!@!@!    !@!";    
	@echo "@!@  !@!  @!!!:!    @!@  !@!  @!!!:!    @!!       @!@  !@!  @!@@!@!   @!@@!@!   @!!!:!    @!! !!@ @!@  @!!!:!    @!@ !!@!    @!!";    
	@echo "!@!  !!!  !!!!!:    !@!  !!!  !!!!!:    !!!       !@!  !!!  !!@!!!    !!@!!!    !!!!!:    !@!   ! !@!  !!!!!:    !@!  !!!    !!!";    
	@echo "!!:  !!!  !!:       :!:  !!:  !!:       !!:       !!:  !!!  !!:       !!:       !!:       !!:     !!:  !!:       !!:  !!!    !!:";    
	@echo ":!:  !:!  :!:        ::!!:!   :!:        :!:      :!:  !:!  :!:       :!:       :!:       :!:     :!:  :!:       :!:  !:!    :!:";    
	@echo " :::: ::   :: ::::    ::::     :: ::::   :: ::::  ::::: ::   ::        ::        :: ::::  :::     ::    :: ::::   ::   ::     ::";    
	@echo ":: :  :   : :: ::      :      : :: ::   : :: : :   : :  :    :         :        : :: ::    :      :    : :: ::   ::    :      :";     
	@echo "--------------------------------------------------";
	@echo "DEV MODE";
	@echo "--------------------------------------------------";

	npm run watch

prod: 
	@echo "--------------------------------------------------";
	@echo "@@@@@@@   @@@@@@@    @@@@@@   @@@@@@@   @@@  @@@   @@@@@@@  @@@@@@@  @@@   @@@@@@   @@@  @@@";  
	@echo "@@@@@@@@  @@@@@@@@  @@@@@@@@  @@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@  @@@  @@@@@@@@  @@@@ @@@";  
	@echo "@@!  @@@  @@!  @@@  @@!  @@@  @@!  @@@  @@!  @@@  !@@         @@!    @@!  @@!  @@@  @@!@!@@@";  
	@echo "!@!  @!@  !@!  @!@  !@!  @!@  !@!  @!@  !@!  @!@  !@!         !@!    !@!  !@!  @!@  !@!!@!@!";  
	@echo "@!@@!@!   @!@!!@!   @!@  !@!  @!@  !@!  @!@  !@!  !@!         @!!    !!@  @!@  !@!  @!@ !!@!";  
	@echo "!!@!!!    !!@!@!    !@!  !!!  !@!  !!!  !@!  !!!  !!!         !!!    !!!  !@!  !!!  !@!  !!!";  
	@echo "!!:       !!: :!!   !!:  !!!  !!:  !!!  !!:  !!!  :!!         !!:    !!:  !!:  !!!  !!:  !!!";  
	@echo ":!:       :!:  !:!  :!:  !:!  :!:  !:!  :!:  !:!  :!:         :!:    :!:  :!:  !:!  :!:  !:!";  
	@echo " ::       ::   :::  ::::: ::   :::: ::  ::::: ::   ::: :::     ::     ::  ::::: ::   ::   ::";  
	@echo " :         :   : :   : :  :   :: :  :    : :  :    :: :: :     :     :     : :  :   ::    :";   
	@echo "--------------------------------------------------";
	@echo "PROD MODE";
	@echo "--------------------------------------------------";

	git pull && \
	npm install && \
	npm run prod