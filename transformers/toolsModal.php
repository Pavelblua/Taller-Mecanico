<?php

namespace transformers;

class toolsModal
{
    public function typeModal(string $type)
    {
        switch ($type) {
            case 'success':
                return 'text-bg-success p-3';
            case 'error':
                return 'text-bg-danger p-3';
            case 'warning':
                return 'text-bg-warning p-3';
            default:
                return '';
        }
    }

    public function iconModal(string $type)
    {
        switch ($type) {
            case 'success':
                return 'bi bi-check-circle-fill fs-1';
            case 'error':
                return 'bi bi-x-circle-fill fs-1';
            case 'warning':
                return 'bi bi-exclamation-triangle-fill fs-1';
            default:
                return '';
        }
    }

    public function buttonModal(string $type)
    {
        switch ($type) {
            case 'success':
                return 'btn-success';
            case 'error':
                return 'btn-danger';
            case 'warning':
                return 'btn-warning';
            default:
                return '';
        }
    }

    public function textColorModal(string $type)
    {
        switch ($type) {
            case 'success':
                return 'text-success';
            case 'error':
                return 'text-danger';
            case 'warning':
                return 'text-warning';
            default:
                return '';
        }
    }

}
