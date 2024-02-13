<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class LogVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $visitor = new Visitor();
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $visitor->ip_address = $ipAddress;
        $visitor->user_agent = $userAgent;

        $lastVisit = Visitor::where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->where('visit_time', '>=', Carbon::now()->subMinutes(5))
            ->first();

        if (!$lastVisit) {
            // Создание новой записи о посещении
            Visitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'visit_time' => Carbon::now()
            ]);
        }

        // Delete get parametrs

        $requestt = $request->getRequestUri();
        if (strpos($requestt, '?') !== false) {
            return redirect()->to('/', 301);
        }
        
        $response = $next($request);
        
        $response->header('X-Robots-Tag', 'index, follow');

        return $response;
    }
}
