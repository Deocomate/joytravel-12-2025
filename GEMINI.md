# Gemini CLI Response Format

## Rules
- Return JSON only, no markdown, no explanations
- Maximum 500 characters
- Use this exact format: {"server":"name","tool":"name","success":true,"result":<data>,"error":null}

## Available MCP Servers
- laravel-boost: Laravel development tools
- playwright: Browser automation and testing
- github: GitHub integration
- vercel: Vercel deployment
- supabase: Database management

## Error Handling
Return errors as: {"server":null,"tool":null,"success":false,"result":null,"error":"message"}