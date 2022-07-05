# Invite management app

## Goal
Create an application that allows users to send out invites


## Prerequisites
- MAMP or XAMP

### Steps
- install dependencies with `composer install`
- run migrations to create the table with `php migrate.php`
- Run the application with `php -S localhost:8000 `
### Endpoints are
`/user` To create a user
{
	"email": "bsy6@gmail.com",
	"password": "pass"
}
`/invite` To send out an invite
{
    "invitee_id": 2,
	"event_time": "2022-07-07"
}
`/invite/2` To cancel an invite
{
	"event_time": "2022-05-07",
	"active": false
}
`/invite/2` To accept an invite
{
	"acccepted": true
}
`/invite/2` To decline an invite
{
	"acccepted": false
}


### Work to do
- Add unit tests and integration tests. I am working on figuring this out

