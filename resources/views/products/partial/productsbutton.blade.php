   <style>
            .quick-shortcuts {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
                padding: 1rem;
                max-width: 1200px;
                margin: 0 auto;
            }
            
            .shortcut-card {
                background: white;
                border-radius: 0.5rem;
                padding: 1.5rem;
                text-align: center;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                transition: transform 0.2s, box-shadow 0.2s;
                cursor: pointer;
            }
            
            .shortcut-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            .shortcut-card h3 {
                font-size: 1rem;
                font-weight: 600;
                color: #374151;
                margin-top: 0.5rem;
            }
            
            .shortcut-icon {
                font-size: 1.5rem;
                color: #3B82F6;
            }
        </style>