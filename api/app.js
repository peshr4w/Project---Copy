const express = require("express");
const conn = require("./conf");
const cors = require("cors");
const bodyParser = require('body-parser')

const app = express();
app.use(cors({
    origin: "*"
}));
app.use(bodyParser.json())

app.get("/api/posts", (req, res) => {
    conn.query("select * from posts", (err, data) => {
        if (err) throw err;
        res.json({ data });
    });
});
app.get("/api/posts/:id", (req, res) => {
    const id = req.params.id;
    conn.query(`select * from posts where id = ${id} `, (err, data) => {
        if (err) throw err;
        res.json({ data });
    });
});
app.post("/api/posts/:user_id/:title/:description", (req, res) => {
    const userId = req.params.user_id;
    const title = req.params.title;
    const description = req.params.description;
    conn.query(`insert into posts(user_id, title, description) values(${userId}, ${title}, ${description})`, (err, data) => {
        if (err) throw err;
        res.json({ data });
    });
});
app.delete('/api/posts/:id', (req, res) => {
    const id = req.params.id;
    conn.query(`delete from posts where id  = ${id}`, (err, data) => {
        if (err) throw err;
        res.json({ data });
    })
})
app.listen(4000, () => {
    console.log("serving");
});