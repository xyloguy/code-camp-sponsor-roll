# Code Camp Sponsor Reel
A simple and terrible program that was written once and keeps getting used.

## To Use:

### Clone the repo

```bash
git clone https://github.com/xyloguy/code-camp-sponsor-roll.git
```

### Change directories
```bash
cd code-camp-sponsor-roll
```

### Spin up the containers

```bash
docker compose up
```

or, if you don't want to see the logs

```bash
docker compose up -d
```

### Visit your browser

[http://localhost](http://localhost) -- if you need to change the port on your system,
you can update the value "80:80" in the docker-compose.yaml to specify the port (ie "8080:80")


## To modify

Sponsor logos are located in `app/logos` -- _NOTE: any image in the folder will get loaded as a slide._

To update the date modify `app/timer.php` -- change `$then = strtotime('2022-11-12 07:59:59');` to specify the datetime the event should end.