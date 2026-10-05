<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f2f2f0">
    <title>{{ $title ?? 'Direktori Pengguna' }} | Ruang Kelas</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #171717;
            --muted: #656562;
            --paper: #f2f2f0;
            --surface: #ffffff;
            --line: #d6d6d2;
            --soft: #e9e9e6;
            --mid: #898986;
            --font-mono: 'Cascadia Code', 'SFMono-Regular', Consolas, 'Liberation Mono', monospace;
        }

        * { box-sizing: border-box; }
        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            background-color: var(--paper);
            background-image: radial-gradient(#1717170d 0.7px, transparent 0.7px);
            background-size: 14px 14px;
            font-family: var(--font-mono);
        }
        a { color: inherit; text-decoration: none; }
        button, a { -webkit-tap-highlight-color: transparent; }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible { outline: 2px solid var(--ink); outline-offset: 3px; }
        .site-shell { display: flex; min-height: 100vh; flex-direction: column; }
        .site-main { width: min(1120px, calc(100% - 48px)); margin: 0 auto; flex: 1; padding: 76px 0 96px; }

        .site-nav {
            display: flex;
            min-height: 76px;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 0 max(24px, calc((100vw - 1120px) / 2));
            border-bottom: 1px solid #17171720;
            background: #f7f7f5e8;
        }
        .brand { display: inline-flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 700; }
        .brand__mark { display: grid; width: 34px; height: 34px; place-items: center; color: #fff; background: var(--ink); border-radius: 3px; font-size: 12px; }
        .brand__name { line-height: 1.1; }
        .brand__name small { display: block; margin-top: 4px; color: var(--muted); font-size: 9px; font-weight: 500; letter-spacing: 0; }
        .site-nav__links { display: flex; align-items: center; gap: 30px; flex-wrap: wrap; }
        .site-nav__link { color: var(--muted); font-size: 12px; font-weight: 500; transition: color 160ms ease; }
        .site-nav__link:hover, .site-nav__link[aria-current="page"] { color: var(--ink); }
        .site-nav__link[aria-current="page"] { text-decoration: underline; text-decoration-color: var(--ink); text-decoration-thickness: 2px; text-underline-offset: 7px; }

        .directory__intro { display: flex; align-items: end; justify-content: space-between; gap: 32px; margin-bottom: 45px; }
        .eyebrow { margin: 0 0 15px; color: var(--muted); font-size: 10px; font-weight: 600; letter-spacing: 0; text-transform: uppercase; }
        .eyebrow span { padding: 0 7px; color: var(--mid); }
        h1 { margin: 0; font-size: 42px; font-weight: 600; letter-spacing: 0; line-height: 1.15; }
        h1 span { color: var(--mid); }
        .directory__description { margin: 14px 0 0; color: var(--muted); font-size: 15px; }
        .button { display: inline-flex; min-height: 46px; align-items: center; justify-content: center; gap: 10px; padding: 0 17px; border: 1px solid transparent; border-radius: 3px; font-family: inherit; font-size: 12px; font-weight: 600; transition: transform 160ms ease, background 160ms ease; white-space: nowrap; cursor: pointer; }
        .button:hover { transform: translateY(-2px); }
        .button--primary { color: #fff; background: var(--ink); }
        .button--primary:hover { background: #3a3a38; }
        .button--primary span { display: inline-grid; width: 20px; height: 20px; place-items: center; color: var(--ink); background: #fff; border-radius: 2px; font-size: 16px; line-height: 1; }
        .button--secondary { border-color: var(--line); color: var(--ink); background: transparent; }
        .button--secondary:hover { background: var(--soft); }

        .directory__summary { display: flex; min-height: 54px; align-items: center; gap: 11px; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); }
        .directory__summary p { margin: 0; font-size: 12px; }
        .directory__summary strong { font-family: 'Manrope', sans-serif; font-size: 15px; }
        .summary__marker { width: 8px; height: 8px; border-radius: 50%; background: var(--ink); box-shadow: 0 0 0 4px #17171712; }
        .summary__note { margin-left: auto; color: var(--muted); font-size: 11px; }

        .table-frame { overflow: hidden; margin-top: 18px; border: 1px solid var(--line); border-radius: 3px; background: var(--surface); box-shadow: 0 12px 35px #17171708; }
        .table-scroll { overflow-x: auto; }
        .user-table { width: 100%; min-width: 620px; border-collapse: collapse; text-align: left; }
        .user-table th { height: 48px; padding: 0 22px; color: var(--muted); background: #ececea; font-size: 10px; font-weight: 600; letter-spacing: 0; text-transform: uppercase; }
        .user-table td { height: 76px; padding: 0 22px; border-top: 1px solid #e9ece7; font-size: 13px; }
        .user-table tbody tr { transition: background 140ms ease; }
        .user-table tbody tr:hover { background: #f5f5f3; }
        .user-table__id { color: var(--mid); font-size: 12px !important; font-weight: 600; }
        .student { display: flex; align-items: center; gap: 13px; }
        .student__avatar { display: grid; width: 36px; height: 36px; flex: 0 0 36px; place-items: center; color: var(--ink); background: var(--soft); border-radius: 3px; font-size: 12px; font-weight: 600; }
        .student__name { font-weight: 600; }
        .npm { color: var(--muted); font-variant-numeric: tabular-nums; }
        .class-tag { display: inline-flex; align-items: center; padding: 6px 9px; border: 1px solid var(--line); border-radius: 2px; color: var(--ink); background: #f5f5f3; font-size: 11px; font-weight: 500; }
        .empty-state { padding: 54px 20px; color: var(--muted); text-align: center; }
        .empty-state strong { display: block; margin-bottom: 6px; color: var(--ink); font-size: 14px; font-weight: 600; }

        .create-page { display: grid; grid-template-columns: minmax(220px, 0.78fr) minmax(0, 1.22fr); align-items: start; gap: 72px; }
        .create-page__intro { padding-top: 5px; }
        .create-page__back { display: inline-flex; align-items: center; gap: 9px; margin-bottom: 58px; color: var(--muted); font-size: 11px; }
        .create-page__back:hover { color: var(--ink); }
        .create-page__description { max-width: 310px; margin: 16px 0 0; color: var(--muted); font-size: 12px; line-height: 1.8; }
        .form-panel { overflow: hidden; border: 1px solid var(--line); border-radius: 3px; background: var(--surface); box-shadow: 0 12px 35px #17171708; }
        .form-panel__topline { display: flex; min-height: 50px; align-items: center; justify-content: space-between; gap: 16px; padding: 0 24px; border-bottom: 1px solid var(--line); color: var(--muted); background: #f7f7f5; font-size: 10px; font-weight: 600; }
        .user-form { padding: 29px 30px 30px; }
        .form-field { margin-bottom: 24px; }
        .form-field__heading { display: flex; align-items: baseline; justify-content: space-between; gap: 14px; margin-bottom: 9px; }
        .form-field label { font-size: 12px; font-weight: 600; }
        .form-field__number { color: var(--mid); font-size: 10px; }
        .form-field input, .form-field select { display: block; width: 100%; min-height: 48px; padding: 0 13px; border: 1px solid var(--line); border-radius: 2px; color: var(--ink); background: #fff; font: inherit; font-size: 12px; }
        .form-field input::placeholder { color: #969693; }
        .form-field input:focus, .form-field select:focus { outline: 2px solid #17171726; outline-offset: 1px; border-color: var(--ink); }
        .form-field select { cursor: pointer; }
        .form-field__error { margin: 8px 0 0; color: #363634; font-size: 11px; line-height: 1.5; }
        .form-field__error::before { content: '! '; font-weight: 700; }
        .form-panel__actions { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; padding-top: 5px; }

        .site-footer { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 24px; padding: 22px max(24px, calc((100vw - 1120px) / 2)); border-top: 1px solid #17171720; color: var(--muted); font-size: 10px; }
        .site-footer p { margin: 0; }
        .site-footer strong { color: var(--ink); }

        @media (max-width: 640px) {
            .site-nav { min-height: 70px; gap: 16px; }
            .site-nav__links { gap: 15px; }
            .site-nav__link { font-size: 12px; }
            .site-main { width: min(100% - 36px, 1120px); padding: 52px 0 68px; }
            h1 { font-size: 32px; }
            .directory__intro { align-items: flex-start; flex-direction: column; gap: 22px; margin-bottom: 32px; }
            .summary__note { display: none; }
            .user-table { min-width: 100%; table-layout: fixed; }
            .user-table th:first-child, .user-table td.user-table__id { display: none; }
            .user-table th:nth-child(2) { width: 42%; }
            .user-table th:nth-child(3) { width: 34%; }
            .user-table th:nth-child(4) { width: 24%; }
            .user-table th, .user-table td { padding-right: 9px; padding-left: 9px; }
            .user-table th { font-size: 8px; }
            .user-table td { font-size: 10px; overflow-wrap: anywhere; }
            .student { gap: 0; }
            .student__avatar { display: none; }
            .class-tag { max-width: 100%; padding: 4px; font-size: 9px; white-space: normal; }
            .empty-state { padding: 32px 8px; }
            .create-page { grid-template-columns: 1fr; gap: 32px; }
            .create-page__back { margin-bottom: 32px; }
            .user-form { padding: 23px 20px 22px; }
            .form-panel__topline { padding: 0 20px; }
        }
        @media (max-width: 380px) {
            .site-nav { padding-right: 18px; padding-left: 18px; }
            .brand { gap: 8px; font-size: 13px; }
            .brand__name small { display: none; }
            .site-nav__links { gap: 11px; }
            .site-nav__link { font-size: 10px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
    <div class="site-shell">
        <x-navbar />
        <main class="site-main">
            @yield('content')
        </main>
        <x-footer />
    </div>
</body>
</html>