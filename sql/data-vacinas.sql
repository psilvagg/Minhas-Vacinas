use minhasvacinas;

INSERT INTO vacina 
    (nome_vac, data_aplicacao, proxima_dose, local_aplicacao, tipo, dose, lote, obs, id_user) 
VALUES
    ('Hepatite B', '2024-01-01', '2025-01-01', 'Clínica Saúde', 'Adulto', 1, 'L123', 'Primeira dose aplicada com sucesso.', 1),
    ('Febre Amarela', '2024-01-05', '2034-01-05', 'UBS Central', 'Adulto', 1, 'FA456', 'Vacina aplicada sem reações adversas.', 1),
    ('Tétano', '2024-01-10', NULL, 'Hospital Regional', 'Adulto', 2, 'T789', 'Reforço de tétano.', 1),
    ('COVID-19', '2024-01-15', '2025-01-15', 'Drive Thru Vacinas', 'Adulto', 3, 'C0123', 'Vacina bivalente.', 1),
    ('Influenza', '2024-01-20', NULL, 'Clínica Saúde', 'Adulto', 1, 'I987', 'Aplicação anual recomendada.', 1),
    ('Sarampo', '2024-01-25', '2026-01-25', 'Centro de Vacinação', 'Infantil', 2, 'S456', 'Primeira dose administrada.', 1),
    ('Poliomielite', '2024-01-30', NULL, 'UBS Oeste', 'Infantil', 3, 'P789', 'Vacina aplicada sem complicações.', 1),
    ('HPV', '2024-02-04', '2024-08-04', 'Clínica Especializada', 'Adulto', 1, 'H123', 'Primeira dose do ciclo.', 1),
    ('Meningite', '2024-02-09', '2024-08-09', 'Hospital Central', 'Adulto', 2, 'M456', 'Dose inicial administrada.', 1),
    ('Rotavírus', '2024-02-14', NULL, 'UBS Norte', 'Infantil', 1, 'R789', 'Vacina aplicada sem efeitos colaterais.', 1),
    ('Difteria', '2024-02-19', NULL, 'Clínica Saúde', 'Adulto', 1, 'D012', 'Vacina aplicada com sucesso.', 1),
    ('Pneumocócica', '2024-02-24', '2025-02-24', 'Centro de Vacinação', 'Adulto', 1, 'P345', 'Primeira dose administrada.', 1),
    ('Varicela', '2024-02-28', '2025-02-28', 'UBS Central', 'Infantil', 2, 'V678', 'Vacina aplicada sem reações.', 1),
    ('Hepatite A', '2024-03-05', '2025-03-05', 'Clínica Especializada', 'Adulto', 1, 'HA901', 'Dose única aplicada.', 1),
    ('Meningocócica', '2024-03-10', NULL, 'Hospital Regional', 'Adulto', 2, 'MN234', 'Reforço administrado.', 1),
    ('HPV', '2024-03-15', '2024-09-15', 'Clínica Saúde', 'Adulto', 1, 'H567', 'Segunda dose do ciclo.', 1),
    ('Influenza', '2024-03-20', NULL, 'UBS Oeste', 'Adulto', 1, 'I890', 'Aplicação anual recomendada.', 1),
    ('COVID-19', '2024-03-25', '2025-03-25', 'Drive Thru Vacinas', 'Adulto', 3, 'C3456', 'Dose de reforço aplicada.', 1),
    ('Sarampo', '2024-03-30', '2026-03-30', 'Centro de Vacinação', 'Infantil', 2, 'S789', 'Segunda dose administrada.', 1),
    ('Poliomielite', '2024-04-04', NULL, 'UBS Norte', 'Infantil', 3, 'P0123', 'Vacina aplicada com sucesso.', 1),
    ('Tétano', '2024-04-09', NULL, 'Hospital Central', 'Adulto', 2, 'T4567', 'Reforço administrado.', 1),
    ('Hepatite B', '2024-04-14', '2025-04-14', 'Clínica Especializada', 'Adulto', 1, 'L890', 'Segunda dose aplicada.', 1),
    ('Febre Amarela', '2024-04-19', '2034-04-19', 'UBS Central', 'Adulto', 1, 'FA789', 'Vacina aplicada sem complicações.', 1),
    ('Difteria', '2024-04-24', NULL, 'Clínica Saúde', 'Adulto', 1, 'D345', 'Vacina administrada com sucesso.', 1),
    ('Pneumocócica', '2024-04-29', '2025-04-29', 'Centro de Vacinação', 'Adulto', 1, 'P678', 'Dose de reforço aplicada.', 1),
    ('Varicela', '2024-05-04', '2025-05-04', 'UBS Central', 'Infantil', 2, 'V901', 'Segunda dose administrada.', 1),
    ('Hepatite A', '2024-05-09', '2025-05-09', 'Clínica Especializada', 'Adulto', 1, 'HA234', 'Dose única aplicada.', 1),
    ('Meningocócica', '2024-05-14', NULL, 'Hospital Regional', 'Adulto', 2, 'MN567', 'Reforço administrado.', 1),
    ('HPV', '2024-05-19', '2024-11-19', 'Clínica Saúde', 'Adulto', 1, 'H890', 'Terceira dose do ciclo.', 1),
    ('Influenza', '2024-05-24', NULL, 'UBS Oeste', 'Adulto', 1, 'I123', 'Aplicação anual recomendada.', 1),
    ('COVID-19', '2024-05-29', '2025-05-29', 'Drive Thru Vacinas', 'Adulto', 3, 'C6789', 'Dose de reforço aplicada.', 1),
    ('Sarampo', '2024-06-03', '2026-06-03', 'Centro de Vacinação', 'Infantil', 2, 'S012', 'Terceira dose administrada.', 1),
    ('Poliomielite', '2024-06-08', NULL, 'UBS Norte', 'Infantil', 3, 'P3456', 'Vacina aplicada com sucesso.', 1),
    ('Tétano', '2024-06-13', NULL, 'Hospital Central', 'Adulto', 2, 'T7890', 'Reforço administrado.', 1),
    ('Hepatite B', '2024-06-18', '2025-06-18', 'Clínica Especializada', 'Adulto', 1, 'L234', 'Segunda dose aplicada.', 1),
    ('Febre Amarela', '2024-06-23', '2034-06-23', 'UBS Central', 'Adulto', 1, 'FA012', 'Vacina aplicada sem complicações.', 1),
    ('Difteria', '2024-06-28', NULL, 'Clínica Saúde', 'Adulto', 1, 'D678', 'Vacina administrada com sucesso.', 1),
    ('Pneumocócica', '2024-07-03', '2025-07-03', 'Centro de Vacinação', 'Adulto', 1, 'P901', 'Dose de reforço aplicada.', 1),
    ('Varicela', '2024-07-08', '2025-07-08', 'UBS Central', 'Infantil', 2, 'V234', 'Segunda dose administrada.', 1),
    ('Hepatite A', '2024-07-13', '2025-07-13', 'Clínica Especializada', 'Adulto', 1, 'HA567', 'Dose única aplicada.', 1),
    ('Meningocócica', '2024-07-18', NULL, 'Hospital Regional', 'Adulto', 2, 'MN890', 'Reforço administrado.', 1),
    ('HPV', '2024-07-23', '2024-01-23', 'Clínica Saúde', 'Adulto', 1, 'H345', 'Quarta dose do ciclo.', 1),
    ('Influenza', '2024-07-28', NULL, 'UBS Oeste', 'Adulto', 1, 'I456', 'Aplicação anual recomendada.', 1),
    ('COVID-19', '2024-08-02', '2025-08-02', 'Drive Thru Vacinas', 'Adulto', 3, 'C9012', 'Dose de reforço aplicada.', 1),
    ('Sarampo', '2024-08-07', '2026-08-07', 'Centro de Vacinação', 'Infantil', 2, 'S345', 'Quarta dose administrada.', 1),
    ('Poliomielite', '2024-08-12', NULL, 'UBS Norte', 'Infantil', 3, 'P6789', 'Vacina aplicada com sucesso.', 1),
    ('Tétano', '2024-08-17', NULL, 'Hospital Central', 'Adulto', 2, 'T0123', 'Reforço administrado.', 1),
    ('Hepatite B', '2024-08-22', '2025-08-22', 'Clínica Especializada', 'Adulto', 1, 'L567', 'Segunda dose aplicada.', 1),
    ('Febre Amarela', '2024-08-27', '2034-08-27', 'UBS Central', 'Adulto', 1, 'FA345', 'Vacina aplicada sem complicações.', 1),
    ('Difteria', '2024-09-01', NULL, 'Clínica Saúde', 'Adulto', 1, 'D890', 'Vacina administrada com sucesso.', 1),
    ('Pneumocócica', '2024-09-06', '2025-09-06', 'Centro de Vacinação', 'Adulto', 1, 'P678', 'Dose de reforço aplicada.', 1),
    ('Varicela', '2024-09-11', '2025-09-11', 'UBS Central', 'Infantil', 2, 'V567', 'Segunda dose administrada.', 1),
    ('Hepatite A', '2024-09-16', '2025-09-16', 'Clínica Especializada', 'Adulto', 1, 'HA890', 'Dose única aplicada.', 1),
    ('Meningocócica', '2024-09-21', NULL, 'Hospital Regional', 'Adulto', 2, 'MN345', 'Reforço administrado.', 1),
    ('HPV', '2024-09-26', '2024-03-26', 'Clínica Saúde', 'Adulto', 1, 'H678', 'Quinta dose do ciclo.', 1),
    ('Influenza', '2024-10-01', NULL, 'UBS Oeste', 'Adulto', 1, 'I789', 'Aplicação anual recomendada.', 1),
    ('COVID-19', '2024-10-06', '2025-10-06', 'Drive Thru Vacinas', 'Adulto', 3, 'C2345', 'Dose de reforço aplicada.', 1),
    ('Sarampo', '2024-10-11', '2026-10-11', 'Centro de Vacinação', 'Infantil', 2, 'S678', 'Quinta dose administrada.', 1),
    ('Poliomielite', '2024-10-16', NULL, 'UBS Norte', 'Infantil', 3, 'P9012', 'Vacina aplicada com sucesso.', 1),
    ('Tétano', '2024-10-21', NULL, 'Hospital Central', 'Adulto', 2, 'T3456', 'Reforço administrado.', 1),
    ('Hepatite B', '2024-10-26', '2025-10-26', 'Clínica Especializada', 'Adulto', 1, 'L789', 'Segunda dose aplicada.', 1),
    ('Febre Amarela', '2024-10-31', '2034-10-31', 'UBS Central', 'Adulto', 1, 'FA901', 'Vacina aplicada sem complicações.', 1),
    ('Difteria', '2024-11-05', NULL, 'Clínica Saúde', 'Adulto', 1, 'D123', 'Vacina administrada com sucesso.', 1),
    ('Pneumocócica', '2024-11-10', '2025-11-10', 'Centro de Vacinação', 'Adulto', 1, 'P345', 'Dose de reforço aplicada.', 1),
    ('Varicela', '2024-11-15', '2025-11-15', 'UBS Central', 'Infantil', 2, 'V678', 'Segunda dose administrada.', 1),
    ('Hepatite A', '2024-11-20', '2025-11-20', 'Clínica Especializada', 'Adulto', 1, 'HA012', 'Dose única aplicada.', 1),
    ('Meningocócica', '2024-11-25', NULL, 'Hospital Regional', 'Adulto', 2, 'MN567', 'Reforço administrado.', 1),
    ('HPV', '2024-11-30', '2024-05-30', 'Clínica Saúde', 'Adulto', 1, 'H890', 'Sexta dose do ciclo.', 1),
    ('Influenza', '2024-12-05', NULL, 'UBS Oeste', 'Adulto', 1, 'I012', 'Aplicação anual recomendada.', 1),
    ('COVID-19', '2024-12-10', '2025-12-10', 'Drive Thru Vacinas', 'Adulto', 3, 'C4567', 'Dose de reforço aplicada.', 1),
    ('Sarampo', '2024-12-15', '2026-12-15', 'Centro de Vacinação', 'Infantil', 2, 'S901', 'Sexta dose administrada.', 1),
    ('Poliomielite', '2024-12-20', NULL, 'UBS Norte', 'Infantil', 3, 'P2345', 'Vacina aplicada com sucesso.', 1),
    ('Tétano', '2024-12-25', NULL, 'Hospital Central', 'Adulto', 2, 'T6789', 'Reforço administrado.', 1),
    ('Hepatite B', '2024-12-30', '2025-12-30', 'Clínica Especializada', 'Adulto', 1, 'L012', 'Segunda dose aplicada.', 1);