# TODO

Global settings to add to humhub hydrogen administration modules:
- A field to set the matrix endpoint url (string)
- A field for the user identifier on matrix. It will be the prefix of the humhub user on matrix server.

## Matrix API

The user need to be logged with matrix API in order to create or add people to room. Use the endpoint set as base url in settings to make api calls.

Matrix documentation link to authenticate and create a room:
* https://matrix.org/docs/api/#post-/_matrix/client/v3/login
* https://matrix.org/docs/api/#post-/_matrix/client/v3/join/-roomIdOrAlias-
* https://matrix.org/docs/api/#post-/_matrix/client/v3/createRoom

A js implementation is available here:
* https://github.com/smart4life/hydrogen-web/blob/master/src/matrix/net/HomeServerApi.ts

It exists some implemtentation in php, but none have been tested. You can try to use them if you want:
* https://packagist.org/packages/meet-kinksters/php-matrix-sdk

## Authentication

Matrix API use "Bearer Authorization" header with the token returned by the login api. It needed for any call

## Start a chat matrix room with another user

The button should call matrix API to create a room an return the roomId created to the JS part of the module. If the room already exist, just return the roomId. When roomId is returned, the js part will call hydrogen javascript to open associated view with.

The room should be private between the 2 users and the roomId predictible or saved. We need to be able to know if the room already exists because matrix allows multiple room between two users but we only want one. So two ways to do: Predictible name in order to catch "duplicate room id" with the API, or saved roomId when users already have created a room between them to avoid creating a new room each time. You can achieve that with roomAlias.

https://matrix.org/docs/api/#get-/_matrix/client/v3/directory/room/-roomAlias-

    `navigation.push("room", roomId);`

The navigation variable is init in the main.ts of humhud-hydrogen module.

Do not display the button when user is on his profile as matrix do not allows to open a room with himself

## Add a button on each space to start a room with matrix

When creating a space, a private matrix room need to be created or a button can be added to create such matrix room

A "open room" button should be displayed only if the user is member of the space (and if the room exists depending on the initial choice). When an administrator/moderator of the space invite someone to the space, it should add the user to the associated matrix room. As before, return the roomId to js to call navigation client side.

https://matrix.org/docs/api/#post-/_matrix/client/v3/rooms/-roomId-/invite-

When someone is removed from the space or leave the space, it should be removed from the matrix room also if it exists.
