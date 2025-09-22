Wilber Hernan Anacona Uni : Examen

INSERT INTO statuses (id, name, description, created_at, updated_at) VALUES
(1, 'activo', 'Estado activooo', NOW(), NOW()),
(2, 'inactivo', 'Estado inactivo', NOW(), NOW()),
(3, 'pendiente', 'Estadoo pendiente', NOW(), NOW());

INSERT INTO roles (id, name, description, status_id, created_at, updated_at) VALUES
(1, 'Admin', 'Admin', 1, NOW(), NOW()),
(2, 'Empleado', 'Empleado', 1, NOW(), NOW()),
(3, 'Usuarioo', 'Cliente usurio', 1, NOW(), NOW());

