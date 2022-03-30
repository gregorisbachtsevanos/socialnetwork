const http = require('http');
const express = require('express');
const app = express();
const { Socket } = require('socket.io');
const server = http.createServer(app)

const io = require('socket.io')(http)
const mysql = require('mysql')

const PORT = 3030

app.get('', (req, res) => {
	res.send('Express server')
})

app.listen(PORT, () => {
	console.log(`Server is listening to port: ${PORT}`)
})