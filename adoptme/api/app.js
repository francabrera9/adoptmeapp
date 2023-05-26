const express = require('express');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
app.use(express.json());

// Habilitar CORS utilizando el middleware cors
app.use(cors());

// Configurar la conexión a la base de datos
const connection = mysql.createConnection({
  host: 'host.docker.internal', // Cambia esto si tu base de datos no está en tu máquina local
  user: 'adoptme-admin',
  password: 'adoptme-password',
  database: 'adoptme'
});

connection.connect((err) => {
  if (err) {
    console.error('Error al conectar a la base de datos:', err);
  } else {
    console.log('Conexión exitosa a la base de datos');
  }
});

// Wellcome to Adoptme API Rest!
app.get('/', (req, res) => {
    res.json(['Wellcome to Adoptme API Rest!']);
});

// Lista de mascotas
app.get('/mascotas', (req, res) => {
    const query = `
    SELECT
      id,
      nombre,
      (CASE WHEN sexo = "M" THEN "Macho" ELSE "Hembra" END) AS sexo,
      color,
      (CASE WHEN tamano = "P" THEN "Pequeño" WHEN tamano = "M" THEN "Mediano" ELSE "Grande" END) AS tamano,
      peso,
      provincia
    FROM
      mascotas
    `;
  
    connection.query(query, (err, rows) => {
      if (err) {
        console.error('Error al ejecutar la consulta:', err);
        res.status(500).send('Error al obtener los mascotas');
      } else {
        res.json(rows);
      }
    });
  });

// Obtiene una mascota
app.get('/mascotas/:id', (req, res) => {
  const { id } = req.params;
  const query = `
  SELECT
    id,
    nombre,
    (CASE WHEN sexo = "M" THEN "Macho" ELSE "Hembra" END) AS sexo,
    color,
    (CASE WHEN tamano = "P" THEN "Pequeño" WHEN tamano = "M" THEN "Mediano" ELSE "Grande" END) AS tamano,
    peso,
    provincia
  FROM
    mascotas
  WHERE id = ?
  `;
  const values = [id];

  connection.query(query, values, (err, rows) => {
      if (err) {
      console.error('Error al ejecutar la consulta:', err);
      res.status(500).send('Error al obtener la mascota');
      } else {
      if (rows.length === 0) {
          res.status(404).send('Mascota no encontrado');
      } else {
          res.json(rows[0]);
      }
      }
  });
});

// Crea una mascota
app.post('/mascotas', (req, res) => {
  const { nombre, sexo, color, tamano, peso, provincia } = req.body;
  const query = 'INSERT INTO `mascotas` (`nombre`, `sexo`, `color`, `tamano`, `peso`, `provincia`) VALUES (?,?,?,?,?,?)';
  const values = [nombre, sexo, color, tamano, peso, provincia];

  connection.query(query, values, (err, result) => {
    if (err) {
      console.error('Error al crear la mascota:', err);
      res.status(500).send('Error al crear la mascota');
    } else {
      const nuevaMascota = {
        id: result.insertId,
        nombre
      };
      res.status(201).json(nuevaMascota);
    }
  });
});

// Actualiza una amscota
app.patch('/mascotas/:id', (req, res) => {
  const { id } = req.params;
  const { nombre, sexo, provincia, color, peso, tamano } = req.body;
  const query = `
    UPDATE mascotas
    SET nombre = ?,
      sexo = ?,
      provincia = ?,
      color = ?,
      peso = ?,
      tamano = ?
    WHERE id = ?
  `;
  const values = [nombre, sexo, provincia, color, peso, tamano, id];

  connection.query(query, values, (err, result) => {
    if (err) {
      console.error('Error al actualizar la mascota:', err);
      res.status(500).send('Error al actualizar la mascota');
    } else {
      if (result.affectedRows === 0) {
        res.status(404).send('Mascota no encontrada');
      } else {
        res.sendStatus(204);
      }
    }
  });
});

// Borra una mascota
app.delete('/mascotas/:id', (req, res) => {
  const { id } = req.params;
  const query = 'DELETE FROM mascotas WHERE id = ?';
  const values = [id];

  connection.query(query, values, (err, result) => {
    if (err) {
      console.error('Error al eliminar la mascota:', err);
      res.status(500).send('Error al eliminar la mascota');
    } else {
      if (result.affectedRows === 0) {
        res.status(404).send('Mascota no encontrada');
      } else {
        res.sendStatus(204);
      }
    }
  });
});


// Registrar un usuario
app.post('/register', (req, res) => {
  const { username, password, email} = req.body;
  const query = 'INSERT INTO `accounts` (`username`, `password`, `email`) VALUES (?,?,?)';
  const values = [username, password, email];

  connection.query(query, values, (err, result) => {
    if (err) {
      console.error('Error al crear el usuario:', err);
      res.status(500).send('Error al crear el usuario');
    } else {
      const nuevoUsuario = {
        id: result.insertId,
        username
      };
      res.status(201).json(nuevoUsuario);
    }
  });
});



// Login
app.post('/login', (req, res) => {
  const { username, password } = req.body;
  const query = `
    SELECT id, username
    FROM accounts
    WHERE username = ? AND password = ?
  `;
  const values = [username, password];

  connection.query(query, values, (err, rows) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err);
      res.status(500).send('Error al iniciar sesión');
    } else {
      if (rows.length === 0) {
        res.status(401).send('Credenciales de inicio de sesión inválidas');
      } else {
        const user = rows[0];
        res.json(user);
      }
    }
  });
});






app.listen(3000, () => {
console.log('Servidor iniciado en http://localhost:3000');
});