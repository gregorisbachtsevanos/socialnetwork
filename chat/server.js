const express = require('express');
const app = express();
const http = require('http');
const { Socket } = require('socket.io');
const server = http.createServer(app)
const io = require('socket.io')(http)
const mysql = require('mysql')

const PORT = 3000

io.on('connection', ()=>{
	console.log(`User connected ${socket.id}`)
})



server.listen(PORT, ()=>{
	console.log(`Server is listening to port: ${PORT}`)
})