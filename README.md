Zadania:

Automatyczne zaladowanie PHP aplikacji na serwer wirtualny
Przyklad: https://github.com/valdemarcz/uwb_app/blob/main/.github/workflows/google.yml

Polaczenie aplikacji z baza danych, na stronie maja byc widoczne dane z bazy.

Automatyczne uruchamianie skryptow SQL, dla tworzenia struktury baz danych/zapelnienia danych w tablicach.
Przyklad: https://github.com/valdemarcz/uwb_app/blob/main/.github/workflows/sql_execution.yaml


======================Sprawozdanie 1====================================
Link do Github repozytorii, oraz opis swojego rozwiazania.

Sprawozdanie odesłać: v.cerniavski@uwb.edu.pl



======================INFO===========================================

| Nr. albumu | Port |
|-----------|--------|
| `89419`   | `8002` |
| `89402`   | `8003` | 
| `89428`   | `8004` | 
| `89412`   | `8005` | 
| `88360`   | `8006` | 
| `89413`   | `8007` | 
| `88327`   | `8008` | 
| `89404`   | `8009` | 
| `89403`   | `8010` | 
| `89411`   | `8011` | 
| `89417`   | `8012` |  



======================PHP aplikacja====================================


Zautomatyzowane umieszczenie aplikacji na serweże Apache2, za pomocą github actions.

# uwb_app (Przykład)
simple php app with connection to database, for deployment VM
https://github.com/valdemarcz/uwb_app

# Przykładowy skrypt dla umieszczenia strony:
https://github.com/valdemarcz/uwb_app/blob/main/.github/workflows/google.yml

Gdzie:
script: sudo /usr/local/bin/deploy_app.sh vc 8081
vc - przykładowa nazwa foldera, gdzie będzie umieszczona aplikacja 
     (rekomendacja wykorzystać numer albumu)
8081 - port, na którym aplikacja będzie udostępniona.

Na jednym serwerze będzie udostępnione kilka aplikacji, 
dlatego został stworzony skrypt: deploy_app.sh
który automatycznie udostępnia aplikację (folder ukazany jako 1 parameter) 
pod portem ukazanym jako 2 parametr oraz restartuje apache serwer, aby zmiany zadziałały.
https://github.com/valdemarcz/uwb_app/blob/main/deploy_app.sh

| Variable Name | Description | value |
|--------------|------------|---------|
| `SERVER_HOST`   | IP of apache server | 34.63.108.128 |
| `DB_USER`     | Database user | `stud` |
| `SSH_KEY` | SSH Private key | `github.com/valdemarcz/uwb_app/gcp_vm_key` |
| `SSH_USER` | SSH Username | `github-actions` |
| `SSH_PASSPHRASE` | SSH Passphrase | `github` |
| `DES_FOLDER` | Where to place php code | `/var/www/89411` |


=============================BAZA DANYCH (MY SQL)======================
Zautomatyzowana inicjalizacja struktury bazy danych, oraz jej aktualizacja.

Przykład: https://github.com/valdemarcz/uwb_app/blob/main/.github/workflows/sql_execution.yaml

GCP_SA_KEY: https://github.com/valdemarcz/uwb_app/blob/main/peak-vista-478015-f6-6e6f1f882985.json

DB_NAME:studNumer albumu przyklad: stud88327

| Variable Name | Description | value |
|--------------|------------|---------|
| `DB_HOST`   | Database host address | 34.58.246.93 |
| `DB_USER`     | Database user | `stud` |
| `DB_NAME`     | Database name (Example) | `stud88327` |
| `DB_PASSWORD` | Database password | `Uwb123!!` |
| `SSH_KEY` | SSH Private key | `github.com/valdemarcz/uwb_app/gcp_vm_key` |
| `SSH_USER` | SSH Username | `github-actions` |
| `SSH_PASSPHRASE` | SSH Passphrase | `github` |

=======================================KUBERNETES====================
Sprawozdanie nr. 2 z Kubernetes odesłać: v.cerniavski@uwb.edu.pl



Przykładowe rozwiązanie:
https://github.com/valdemarcz/uwb_app/blob/main/.github/workflows/deploy_k8s.yaml

Potrzebujemy:

Dockerfile : https://github.com/valdemarcz/uwb_app/blob/main/Dockerfile


Kubernetes manifest pliki, zazwyczaj w folderze k8s
Deployment, Service w naszym przypadku wystarczy.

https://github.com/valdemarcz/uwb_app/tree/main/k8s

Przy sciąganiu image'a z artifactory storage obowiązkowa jest autoryzacja, 
na serwerze w kubernetes stworzony jest secret: regcred

Za pomocą ukazania go w pliku deployment odbywa się autoryzacja.
      imagePullSecrets:
        - name: regcred

| Variable Name | Description | value |
|--------------|------------|---------|
| `SERVER_HOST`   | IP of server | 34.30.137.23 |
| `PROJECT_NAME`     | Name of GC project (For artifactory) | `hopeful-keep-480204-e0` |
| `REPOSITORY_NAME` | Artifactory registry Repo name | `uwb` |
| `REPOSITORY_LOCATION` | Artifactory registry Repo Location | `us-central1` |
| `REPOSITORY_URL` | Artifactory registry Repo URL | `us-central1-docker.pkg.dev/hopeful-keep-480204-e0/uwb` |
| `SSH_KEY` | SSH Private key | `github.com/valdemarcz/uwb_app/gcp_vm_key` |
| `SSH_USER` | SSH Username | `github-actions` |
| `SSH_PASSPHRASE` | SSH Passphrase | `github` |
| `GCP_AUTH_KEY` | GCP Authentication JSON key | `github` |
| `K8S_KEY` | Kubernetes google VM Auth key | `[github.com/valdemarcz/uwb_app/ho](https://github.com/valdemarcz/uwb_app/blob/main/hopeful-keep-480204-e0-ca8f7e4892ea.json)` |    



| Nr. albumu | Port |
|-----------|--------|
| `89419`   | `30002` |
| `89402`   | `30003` | 
| `89428`   | `30004` | 
| `89412`   | `30005` | 
| `88360`   | `30006` | 
| `89413`   | `30007` | 
| `88327`   | `30008` | 
| `89404`   | `30009` | 
| `89403`   | `30010` | 
| `89411`   | `30011` | 
| `89417`   | `30012` | 

## Deployment i Service (Kubernetes)

### Deployment
Deployment odpowiada za uruchamianie i utrzymanie aplikacji w klastrze Kubernetes. Zarządza Podami i dba o to, aby aplikacja działała w zadeklarowanym stanie.

Deployment:
- tworzy i zarządza Podami aplikacji
- utrzymuje zadaną liczbę replik
- restartuje Pody w przypadku awarii
- umożliwia aktualizacje bez przestoju (rolling update) oraz cofanie zmian (rollback)

Plik: `deployment.yaml`

---

### Service
Service zapewnia stabilny dostęp sieciowy do Podów aplikacji, niezależnie od ich liczby i adresów IP.

Service:
- udostępnia stały adres IP oraz nazwę DNS
- rozdziela ruch pomiędzy Pody (load balancing)
- umożliwia dostęp wewnątrz klastra lub z zewnątrz, w zależności od typu Service

Plik: `service.yaml`

---

### Współpraca Deployment i Service
Deployment uruchamia Pody aplikacji, natomiast Service kieruje do nich ruch sieciowy na podstawie etykiet (labels). Dzięki temu aplikacja pozostaje dostępna nawet podczas restartów lub skalowania Podów.
